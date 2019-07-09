import React, { useContext, useEffect, useState, useMemo } from 'react';
import Context from './Context';
import axios from "axios";
import dayjs from 'dayjs';

// 分数値を時間表示に
function timeFormat(num) {
    const hour = Math.floor((num / 60) % 60);
    const min = Math.floor(num % 60);
    return ('00' + hour).slice( -2 ) + ':' + ('00' + min).slice( -2 );
}

export default () => {
    const context = useContext(Context);
    const [
        { tasks, projects, status, priority, filterQuery },
        dispatch
    ] = context.taskReducer;

    const [isLoading, setIsLoading] = useState(false);
    // ソート
    const [sort, setSort] = useState({});

    // Task一覧を取得
    const fetchData = async () => {

        setIsLoading(true);

        await axios
            .get('/api/users')
            .then(response => {
                dispatch({
                    type: 'setUsers',
                    payload: response.data.data
                });
            }).catch(error => {
                window.notice('データの取得に失敗しました。', 'error');
            });

        await axios
            .get('/api/projects')
            .then(response => {
                dispatch({
                    type: 'setProjects',
                    payload: response.data.data
                });
            }).catch(error => {
                window.notice('データの取得に失敗しました。', 'error');
            });

        await axios
            .get('/api/tasks')
            .then(response => {
                dispatch({
                    type: 'setTasks',
                    payload: response.data.data
                });
            }).catch(error => {
                window.notice('データの取得に失敗しました。', 'error');
            });

        setIsLoading(false);
    };

    useEffect(() => {
        fetchData();
    }, []);

    // データ再読み込み
    const handleReload = () => {
        fetchData();
    };

    // 選択したカラムでソートする
    const handleSort = column => {
        /*if (sort.key === column) {
            setSort({ ...sort, order: -sort.order });
        } else {
            setSort({
                key: column,
                order: 1
            })
        }*/

        if (sort.key === column) {
            setSort({ ...sort, order: !sort.order });
        } else {
            setSort({
                key: column,
                order: true
            })
        }

    };

    // 絞り込み検索
    const filteredTask = useMemo(() => {
        let tmpTasks = tasks;
        const filterTitle = filterQuery.title && filterQuery.title.toLowerCase();

        // 絞り込み検索
        tmpTasks = tmpTasks.filter(row => {

            // ステータス絞り込み
            if (filterQuery.status_id) {
                // 0は完了以外の表示
                if (parseInt(filterQuery.status_id) === 0) {
                    if (row.status_id === 4) {
                        return;
                    }
                } else if (row.status_id !== parseInt(filterQuery.status_id)) {
                    return;
                }
            }

            // ユーザー絞り込み
            if (filterQuery.user_id) {
                if (!row.user || row.user.id !== parseInt(filterQuery.user_id)) {
                    return;
                }
            }

            // プロジェクト絞り込み
            if (
                filterQuery.project_id &&
                row.project_id !== parseInt(filterQuery.project_id)
            ) {
                return;
            }

            // タイトルで絞り込み
            if (
                filterQuery.title &&
                String(row.title).toLowerCase().indexOf(filterTitle) === -1
            ) {
                return;
            }

            // 期限で絞り込み
            if (filterQuery.due_at && filterQuery.due_at[0] !== '') {
                const thisDueDate = dayjs(row.due_at).format('YYYY-MM-DD');

                // 一つの日だけ選択されている場合
                if ( filterQuery.due_at.length === 1 &&
                     filterQuery.due_at[0] !== thisDueDate ) {
                    return;
                }
                // 範囲選択の場合はその範囲に含まれていないか
                else if (filterQuery.due_at.length === 2 &&
                    !(filterQuery.due_at[0] <= thisDueDate &&
                    filterQuery.due_at[1] >= thisDueDate )) {
                    return;
                }
            }

            return row;
        });

        if ( sort.key ) {
            tmpTasks = tmpTasks.sort((a, b) => {
                a = a[sort.key];
                b = b[sort.key];
                // return (a === b ? 0 : a > b ? 1 : -1) * sort.order;

                // null が入るソート
                if (a === b) return 0;
                else if (a === null) return 1;
                else if (b === null) return -1;
                else if (sort.order) return a < b ? -1 : 1;
                else return a < b ? 1 : -1;
            });
        }

        return tmpTasks;
    }, [filterQuery, sort, tasks]);

    const handleTimer = async task => {
        await axios
            .put('/api/tasks/timer/' + task.id, task)
            .then(response => {
                dispatch({
                    type: 'updateTask',
                    payload: response.data.data
                });
            })
            .catch(error => {
                window.notice('タイマーの開始に失敗しました。', 'error');
            });
    };

    return (
        <>
        <div className="task-head">
            <button
                className="btn is-sm is-icon"
                id="refresh-btn"
                onClick={handleReload}
            >
                <i className="remixicon-refresh-line"></i>更新
            </button>
            <button
                className="btn is-sm is-icon is-orange"
                onClick={() => {
                    dispatch({
                        type: 'inputModal',
                        payload: { isInputModal: true }
                    })
                }}>
                <i className="remixicon-add-circle-line"></i>新規登録
            </button>
        </div>
        { isLoading ?
            <div className="loader" /> :
            <div className="task-list table-sticky">
                <table className="table is-stripe">
                    <thead>
                    <tr>
                        <th className="cell-do"></th>
                        <th className="cell-id" onClick={() => handleSort('id')}>ID</th>
                        <th className="cell-status" onClick={() => handleSort('status_id')}>状態</th>
                        <th className="cell-priority" onClick={() => handleSort('priority_id')}>優先度</th>
                        <th className="cell-title">件名</th>
                        <th className="cell-project" onClick={() => handleSort('project_id')}>プロジェクト</th>
                        <th onClick={() => handleSort('due_at')}>期日</th>
                        <th onClick={() => handleSort('created_at')}>登録日</th>
                        <th onClick={() => handleSort('user_id')}>担当</th>
                        <th>時間</th>
                        <th>アクション</th>
                    </tr>
                    </thead>
                    <tbody>
                    {
                        filteredTask.map(task => {
                            return(
                                <tr key={ task.id } className={task.start_at && 'run'}>
                                    <td className="cell-do">
                                        {task.user &&
                                            <i className={
                                                task.start_at ? 'remixicon-pause-fill' : 'remixicon-play-fill'
                                            } onClick={() => handleTimer(task)}></i>
                                        }
                                    </td>
                                    <td>{( '0000' + task.id ).slice( -4 )}</td>
                                    <td className="cell-status">
                                    <span className={'label is-' + status[task.status_id].color}>
                                        {status[task.status_id].label}
                                    </span>
                                    </td>
                                    <td className={'cell-priority ' + (task.priority_id == 1 && 'is-high')}>
                                        {priority[task.priority_id]}
                                    </td>
                                    <td className="cell-title">{task.title}</td>
                                    <td><a href={'/project/' + task.project_id}>
                                    {
                                        task.project_id &&
                                            projects.find(x => x.id === task.project_id).title
                                    }
                                    </a></td>
                                    <td>{task.due_at && dayjs(task.due_at).format('YY/MM/DD')}</td>
                                    <td>{dayjs(task.created_at).format('YY/MM/DD')}</td>
                                    <td>{task.user ? task.user.display_name : '未設定'}</td>
                                    <td>{timeFormat(task.time)}</td>
                                    <td className="cell-action">
                                        <a title="編集" onClick={() => {
                                            dispatch({
                                                type: 'inputModal',
                                                payload: {
                                                    task: task,
                                                    isInputModal: true
                                                }
                                            })
                                        }}>
                                            <i className="remixicon-file-edit-line"></i>
                                        </a>
                                        <a title="削除" onClick={() => {
                                            dispatch({
                                                type: 'deleteModal',
                                                payload: {
                                                    task: task,
                                                    isDeleteModal: true
                                                }
                                            })
                                        }}>
                                            <i className="remixicon-close-line"></i>
                                        </a>
                                    </td>
                                </tr>
                            );
                        })
                    }
                    </tbody>
                </table>
            </div>
        }
        </>
    );
};

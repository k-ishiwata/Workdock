import React, { useEffect } from 'react';
import axios from 'axios';
import { TaskContainer } from './Task';
import dayjs from 'dayjs';

// 分数値を時間表示に
function timeFormat(num) {
    const hour = Math.floor((num / 60) % 60);
    const min = Math.floor(num % 60);
    return ('00' + hour).slice( -2 ) + ':' + ('00' + min).slice( -2 );
}

export default () => {
    const container = TaskContainer.useContainer();

    /*
    async function fetchTasks() {
        await axios
            .get('/api/tasks')
            .then(response => {
                container.setTasks(response.data);
            }).catch(error => {
                // this.setState({
                //     error: true
                // });
            });
    }
     */

    // Task一覧を取得
    const fetchData = async () => {
        await axios
            .get('/api/users')
            .then(response => {
                container.setUsers(response.data.data);
            }).catch(error => {
                container.setAlert({
                    isShow: true,
                    message: 'データの取得に失敗しました。',
                    status: 'error'
                });
            });

        await axios
            .get('/api/projects')
            .then(response => {
                container.setProjects(response.data.data);
            }).catch(error => {
                container.setAlert({
                    isShow: true,
                    message: 'データの取得に失敗しました。',
                    status: 'error'
                });
            });

        await axios
            .get('/api/tasks')
            .then(response => {
                container.setTasks(response.data.data);
            }).catch(error => {
                container.setAlert({
                    isShow: true,
                    message: 'データの取得に失敗しました。',
                    status: 'error'
                });
            });
    };

    useEffect(() => {
        // 読み込み時は完了以外表示
        container.setSearchQuery({ status_id: '0' });
        fetchData();
    }, []);

    const handleReload = () => {
        fetchData();
    };

    const list = container.filteredTask().map((task) => {
        return <tr key={task.id}>
            <td className="cell-do">
                {task.user ? <i className="remixicon-play-fill"></i> : ''}
            </td>
            <td>{( '0000' + task.id ).slice( -4 )}</td>
            <td className="cell-status">
                <span className={'label is-' + container.status[task.status_id].color}>
                    {container.status[task.status_id].label}
                </span>
            </td>
            <td className={'cell-priority ' + (task.priority_id == 1 ? 'is-high' : null)}>
                {container.priority[task.priority_id]}
            </td>
            <td className="cell-title">{task.title}</td>
            <td><a href={'/project/' + task.project_id}>
                {
                    task.project_id ?
                        container.projects.find(x => x.id === task.project_id).title : ''
                }
            </a></td>
            <td>{task.due_at ? dayjs(task.due_at).format('YY/MM/DD') : ''}</td>
            <td>{dayjs(task.created_at).format('YY/MM/DD')}</td>
            <td>{task.user ? task.user.display_name : '未設定'}</td>
            <td>{timeFormat(task.time)}</td>
            <td className="cell-action">
                <a title="詳細"><i className="remixicon-file-text-line"></i></a>
                <a title="編集" onClick={() => container.handleEditModal(task)}><i className="remixicon-file-edit-line"></i></a>
                <a title="削除" onClick={() => container.handleDeleteModal(task)}><i className="remixicon-close-line"></i></a>
                {/*<a title="削除" onClick={() => container.setIsDeleteModal(true)}><i className="remixicon-close-line"></i></a>*/}
            </td>
        </tr>;
    });
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
                    onClick={container.handleAddModal}>
                    <i className="remixicon-add-circle-line"></i>新規登録
                </button>
            </div>
            <div className="task-list table-sticky">
                <table className="table is-stripe">
                    <thead>
                    <tr>
                        <th className="cell-do"></th>
                        <th className="cell-id">ID</th>
                        <th className="cell-status">状態</th>
                        <th className="cell-priority">優先度</th>
                        <th className="cell-title">件名</th>
                        <th className="cell-project">プロジェクト</th>
                        <th>期日</th>
                        <th>登録日</th>
                        <th>担当</th>
                        <th>時間</th>
                        <th>アクション</th>
                    </tr>
                    </thead>
                    <tbody>
                    {list}
                    </tbody>
                </table>
            </div>
            <div className="table-footer">
                <ul className="pagination" role="navigation">
                    <li className="page-item disabled" aria-disabled="true" aria-label="« Previous">
                        <span className="page-link" aria-hidden="true">‹</span>
                    </li>
                    <li className="page-item active" aria-current="page"><span className="page-link">1</span></li>
                    <li className="page-item"><a className="page-link" href="#">2</a></li>
                    <li className="page-item"><a className="page-link" href="#">3</a></li>
                    <li className="page-item"><a className="page-link" href="#">4</a></li>
                    <li className="page-item"><a className="page-link" href="#">5</a></li>
                    <li className="page-item"><a className="page-link" href="#">6</a></li>
                    <li className="page-item"><a className="page-link" href="#">7</a></li>
                    <li className="page-item"><a className="page-link" href="#">8</a></li>

                    <li className="page-item disabled" aria-disabled="true"><span className="page-link">...</span>
                    </li>
                    <li className="page-item"><a className="page-link" href="#">19</a></li>
                    <li className="page-item"><a className="page-link" href="#">20</a></li>

                    <li className="page-item">
                        <a className="page-link" href="#" rel="next" aria-label="Next »">›</a>
                    </li>
                </ul>
            </div>
        </>
    );
}

import { useState } from 'react';
import axios from "axios";
import update from 'immutability-helper';

export default () => {
    const initialTaskState = {
        title: '',
        status_id: 1,
        // time: 0,
        due_at: '',
        user_id: 0,
        priority_id: 0
    };
    const [tasks, setTasks] = useState([]);
    const [users, setUsers] = useState([]);
    const [projects, setProjects] = useState([]);
    const [isInputModal, setIsInputModal] = useState(false);
    const [isDeleteModal, setIsDeleteModal] = useState(false);
    const [task, setTask] = useState(initialTaskState);
    // 検索キーワード
    const [searchQuery, setSearchQuery] = useState({
        status_id: 0
    });
    // 編集中のタスク
    const [editTask, setEditTask] = useState(initialTaskState);
    const [priority, setPriority] = useState([
        null, '高', '中', '低',
    ]);

    const [alert, setAlert] = useState({
        isShow: false,
        message: '',
        status: '',
        // user: null
    });
    const [status, setStatus] = useState([
        {},
        {
            label: '未着手',
            color: null
        },{
            label: '待機',
            color: 'purple'
        },{
            label: '進行中',
            color: 'orange'
        },{
            label: '完了',
            color: 'green'
        }
    ]);

    // 削除処理
    const handleDelete = async e => {
        e.preventDefault();

        await axios.delete('/api/tasks/' + task.id)
            .then(response => {
                // const newTasks = [...tasks];
                // const index = newTasks.indexOf(task);
                // newTasks.splice(index, 1);
                // setTasks(newTasks);

                const index = tasks.findIndex(x => x.id === task.id);
                setTasks( update(tasks, {$splice: [[index, 1]]}) );

                setTask(initialTaskState);

                setIsDeleteModal(false);
                setAlert({
                    isShow: true,
                    message: 'データを削除しました。'
                });
            }).catch(error => {
                setAlert({
                    isShow: true,
                    message: 'データの削除に失敗しました。',
                    status: 'error'
                });
            });
    };

    // 保存処理
    const handleSubmit = async e => {
        e.preventDefault();

        // idがあれば更新、なければ作成
        if (task.id) {
            await axios
                .put('/api/tasks/' + task.id, task)
                .then(response => {
                    const data = response.data.data;
                    const index = tasks.findIndex(x => x.id === data.id);
                    setTasks(update(tasks, {[index]: {$set: data}}));

                    // const newTask = response.data;
                    // setTasks(tasks.map(t => (t.id === newTask.id ? newTask : t)));

                    setAlert({
                        isShow: true,
                        message: 'データを更新しました。'
                    });
                })
                .catch(error => {
                    let errorMessage = 'データの更新に失敗しました。';

                    if (error.response) {
                        errorMessage = error.response.data.errors[0];
                    }
                    setAlert({
                        isShow: true,
                        message: errorMessage,
                        status: 'error'
                    });
                });

            // Object.assign(task, newTask);
        } else {
            await axios
                .post('/api/tasks', task)
                .then(response => {
                    // setTasks([response.data, ...tasks]);
                    // 先頭に追加
                    setTasks(update(tasks, {$unshift: [response.data.data]}));

                    setAlert({
                        isShow: true,
                        message: 'データを登録しました。'
                    });
                }).catch(error => {
                    let errorMessage = 'データの更新に失敗しました。';

                    if (error.response) {
                        errorMessage = error.response.data.errors[0];
                    }
                    setAlert({
                        isShow: true,
                        message: errorMessage,
                        status: 'error'
                    });
                });
        }

        setIsInputModal(false);
    };

    // 削除モーダル
    const handleDeleteModal = task => {
        setTask(task);
        setIsDeleteModal(true);
    };

    // 編集モーダル
    const handleEditModal = task => {
        setTask(task);
        setIsInputModal(true);
    };

    // 新規作成モーダル
    const handleAddModal = () => {
        setTask(initialTaskState);
        setIsInputModal(true);
    };

    // 絞り込み検索
    const filteredTask = () => {
        let data = tasks;
        const filterTitle = searchQuery.title && searchQuery.title.toLowerCase();

        return data.filter(row => {
            // ステータス絞り込み
            if (searchQuery.status_id) {
                // 0は完了以外の表示
                if (parseInt(searchQuery.status_id) === 0) {
                    if (row.status_id === 4) {
                        return false;
                    }
                } else if (row.status_id !== parseInt(searchQuery.status_id)) {
                    return false;
                }
            }

            // プロジェクト絞り込み
            if (searchQuery.project_id) {
                if (row.project_id !== parseInt(searchQuery.project_id)) {
                    return false;
                }
            }

            // ユーザー絞り込み
            if (searchQuery.user_id) {
                if (row.user) {
                    if (row.user.id !== parseInt(searchQuery.user_id)) {
                        return false;
                    }
                }
            }

            // タイトル絞り込み
            if (filterTitle) {
                if (String(row.title).toLowerCase().indexOf(filterTitle) === -1) {
                    return false;
                }
            }

            return row;
        });
    };

    return {
        task, setTask,
        tasks, setTasks,
        users, setUsers,
        projects, setProjects,
        searchQuery, setSearchQuery,
        isInputModal, setIsInputModal,
        isDeleteModal, setIsDeleteModal,
        alert, setAlert,
        priority, status,
        handleSubmit,   // 保存処理
        handleDelete,   // 削除処理
        // モーダル表示
        handleDeleteModal, handleEditModal, handleAddModal,
        filteredTask
    };
}



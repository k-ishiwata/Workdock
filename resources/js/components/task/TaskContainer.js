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
    const [searchQuery, setSearchQuery] = useState({});
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
            // console.log("腰新");
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

    const handleAddModal = () => {
        setTask(initialTaskState);
        setIsInputModal(true);
    };

    // 絞り込み検索
    const filterTask = () => {
        let tmpTasks = tasks;

        if (searchQuery.project_id) {
            tmpTasks = tmpTasks.filter(item => item.project_id === parseInt(searchQuery.project_id));
        }

        if (searchQuery.user_id) {
            tmpTasks = tmpTasks.filter(item => {
                if (item.user) {
                    return item.user.id === parseInt(searchQuery.user_id);
                } else {
                    return false;
                }
            });
        }

        return tmpTasks;
        // return tasks;
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
        filterTask
    };
}



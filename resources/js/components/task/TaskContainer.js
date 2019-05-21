import { useState } from 'react';
import axios from "axios";

// import update from 'immutability-helper';

export default () => {
    const [tasks, setTasks] = useState([]);
    const [isInputModal, setIsInputModal] = useState(false);
    const [isDeleteModal, setIsDeleteModal] = useState(false);
    // 編集中のタスク
    const [editTask, setEditTask] = useState({});
    const [priority, setPriority] = useState([
        '高', '中', '低',
    ]);
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

    // 追加
    const handleAdd = async (e) => {
        e.preventDefault();

        const newTask = {
            title: e.target.title.value
        };

        await axios
            .post('/api/tasks', newTask)
            .then(response => {
                setTasks([response.data, ...tasks]);
            }).catch(error => {
            });

        setIsInputModal(false);
    };

    const handleDelete = async () => {
        await axios.delete('/api/tasks/' + editTask.id)
            .then(response => {
                const newTasks = [...tasks];
                const index = newTasks.indexOf(task);

                newTasks.splice(index, 1);
                setTasks(newTasks);
            }).catch(error => {
            });
    };

    // 削除モーダル
    const handleDeleteModal = (task) => {
        setEditTask(task);
        setIsDeleteModal(true);
    };

    return {
        tasks, setTasks,
        editTask,
        isInputModal, setIsInputModal,
        isDeleteModal, setIsDeleteModal,
        priority, status,
        handleAdd, handleDelete, handleDeleteModal
    };
}



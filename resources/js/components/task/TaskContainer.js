import { useState } from 'react';
import axios from "axios";

// import update from 'immutability-helper';

export default () => {
    const [tasks, setTasks] = useState([]);
    const [isInputOpen, setIsInputOpen] = useState(false);
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

        setIsInputOpen(false);
    };

    return { tasks, setTasks, isInputOpen, setIsInputOpen, priority, status, handleAdd };
}



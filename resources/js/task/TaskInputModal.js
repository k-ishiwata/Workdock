import React,{ useContext, useRef, useEffect } from 'react';
import dayjs from 'dayjs';
import Context from "./Context";
import axios from "axios";

export default () => {
    const context = useContext(Context);
    const [
        { isInputModal, task, priority, projects, status },
        dispatch
    ] = context.taskReducer;

    // Flatpickr は月を変えるとイベントが実行されないのでrefで取得する
    const dueDateRef = useRef();

    const handleChange = e => {
        const { name, value } = e.target;

        dispatch({
            type: 'setTask',
            payload: { ...task, [name]: value }
        });
    };

    const handleClose = () => {
        dispatch({
            type: 'inputModal',
            payload:
                {
                    task: {},
                    isInputModal: false
                }
        })
    };

    const handleSubmit = async e => {
        e.preventDefault();

        let tmpTask = {...task};

        // DateInput は個別に取得
        tmpTask.due_at = dueDateRef.current.value;


        // idがあれば更新、なければ作成
        if (tmpTask.id) {
            await axios
                .put('/api/tasks/' + tmpTask.id, tmpTask)
                .then(response => {
                    dispatch({
                        type: 'updateTask',
                        payload: response.data.data
                    });
                    window.notice('データを更新しました。');
                })
                .catch(error => {
                    window.notice('データの更新に失敗しました。', 'error');
                });
        } else {
            await axios
                .post('/api/tasks', tmpTask)
                .then(response => {
                    dispatch({
                        type: 'addTask',
                        payload: response.data.data
                    });
                    window.notice('データを登録しました。');
                }).catch(error => {
                    window.notice('データの登録に失敗しました。', 'error');
                });
        }
    };

    useEffect(() => {
        // dueDateRef.current.value = task.due_at;

    }, [isInputModal]);

    return (
        <div className={`overlay ${isInputModal && "is-open"}`}>
            <div className="modal panel">
                <h3 className="panel-title">
                    { task.id ? '編集' : '新規登録' }
                </h3>
                {/*<form className="form is-horizontal" onSubmit={handleAdd}>*/}
                <form className="form is-horizontal">
                    <div className="panel-body">
                        <input type="hidden" name="id" defaultValue={task.id || ''} />
                        <div className="input-group">
                            <label className="form-label">件名</label>
                            <input type="text" name="title" className="form-input"
                                   value={task.title || ''}
                                   onChange={handleChange}
                            />
                        </div>
                        <div className="input-group">
                            <label className="form-label">状態</label>
                            <div className="form-input">
                                <div className="select-box">
                                    <select name="status_id"
                                            value={task.status_id}
                                            onChange={handleChange}
                                    >
                                    {
                                        status.map((item, index) => {
                                            if (index !== 0) {
                                                return (
                                                    <option
                                                        key={index}
                                                        value={index}>
                                                        {item.label}
                                                    </option>
                                                );
                                            }
                                        })
                                    }
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div className="input-group">
                            <label className="form-label">期日</label>
                            {/*<Flatpickr*/}
                            {/*    data-enable-time*/}
                            {/*    className='form-input'*/}
                            {/*    value={task.due_at || ''}*/}
                            {/*    // onChange={handleDateChange}*/}
                            {/*    // onChange={data => {*/}
                            {/*    //     console.log(dispatch);*/}
                            {/*    //     // handleDateChange(instance, 'due_at');*/}
                            {/*    // }}*/}
                            {/*/>*/}

                            <input type="text" name="due_at" className="form-input data-input"
                                   value={
                                       task.due_at ?
                                           dayjs(task.due_at).format('YYYY-MM-DD HH:mm') : ''
                                   }
                                   ref={dueDateRef}
                                   onChange={handleChange}
                            />
                        </div>
                        {/*<div className="input-group">*/}
                        {/*    <label className="form-label">担当</label>*/}
                        {/*    <div className="form-input">*/}
                        {/*       <div className="select-box">*/}
                        {/*            <select name="user_id"*/}
                        {/*                    defaultValue={task.user_id || ''}*/}
                        {/*                    onChange={handleChange}*/}
                        {/*            >*/}
                        {/*                <option>担当者</option>*/}
                        {/*                {*/}
                        {/*                    users.map((item) => {*/}
                        {/*                        return (*/}
                        {/*                            <option*/}
                        {/*                                key={item.id}*/}
                        {/*                                value={item.id}>*/}
                        {/*                                {item.display_name}*/}
                        {/*                            </option>*/}
                        {/*                        );*/}
                        {/*                    })*/}
                        {/*                }*/}
                        {/*            </select>*/}
                        {/*       </div>*/}
                        {/*    </div>*/}
                        {/*</div>*/}
                        <div className="input-group">
                            <label className="form-label">優先度</label>
                            <div className="form-input">
                                <div className="select-box">
                                    <select name="priority_id"
                                            value={task.priority_id || ''}
                                            onChange={handleChange}
                                    >
                                        {
                                            priority.map((item, index) => {
                                                return (
                                                    <option
                                                        key={index}
                                                        value={index}>
                                                        {item}
                                                    </option>
                                                );
                                            })
                                        }
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div className="input-group">
                            <label className="form-label">プロジェクト</label>
                            <div className="form-input">
                                <div className="select-box">
                                    <select name="project_id"
                                            value={task.project_id || ''}
                                            onChange={handleChange}
                                    >
                                        <option></option>
                                        {
                                            projects.map((item) => {
                                                return (
                                                    <option
                                                        key={item.id}
                                                        value={item.id}>
                                                        {item.title}
                                                    </option>
                                                );
                                            })
                                        }
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="panel-footer">
                        <button
                            className="btn is-primary"
                            onClick={handleSubmit}>
                            保存
                        </button>
                        <a
                            className="btn close-btn"
                            onClick={handleClose}>
                            キャンセル
                        </a>
                    </div>
                </form>
            </div>
        </div>
    );
}

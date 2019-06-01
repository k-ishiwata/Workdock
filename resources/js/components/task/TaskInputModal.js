import React from 'react';
import { TaskContainer } from './Task';

export default () => {
    const container = TaskContainer.useContainer();

    const handleChange = e => {
        const { name, value } = e.target;
        container.setTask({ ...container.task, [name]: value });
    };

    // const formSubmit = container.editTask === {} ? container.handleAdd : container.handleEdit;

    return (
        <div className={`overlay ${container.isInputModal && "is-open"}`}>
            <div className="modal panel">
                <h3 className="panel-title">新規登録</h3>
                {/*<form className="form is-horizontal" onSubmit={container.handleAdd}>*/}
                <form className="form is-horizontal">
                    <div className="panel-body">
                        <input type="hidden" name="id" value={container.task.id || ''} />
                        <div className="input-group">
                            <label className="form-label">件名</label>
                            <input type="text" name="title" className="form-input"
                                   value={container.task.title || ''}
                                   onChange={handleChange}
                            />
                        </div>
                        <div className="input-group">
                            <label className="form-label">状態</label>
                            <div className="form-input">
                                <div className="select-box">
                                    <select name="status_id"
                                            value={container.task.status_id}
                                            onChange={handleChange}
                                    >
                                    {
                                        container.status.map((item, index) => {
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
                            <input type="text" name="due_at" className="form-input date-time-input"
                                   value={container.task.due_at || ''}
                                   onChange={handleChange}
                            />
                        </div>
                        <div className="input-group">
                            <label className="form-label">担当</label>
                            <div className="form-input">
                               <div className="select-box">
                                    <select name="user_id"
                                            value={container.task.user_id || ''}
                                            onChange={handleChange}
                                    >
                                        <option>担当者</option>
                                        {
                                            container.users.map((item) => {
                                                return (
                                                    <option
                                                        key={item.id}
                                                        value={item.id}>
                                                        {item.display_name}
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
                            onClick={container.handleSubmit}>
                            保存
                        </button>
                        <a
                            className="btn close-btn"
                            onClick={() => container.setIsInputModal(false)}>
                            キャンセル
                        </a>
                    </div>
                </form>
            </div>
        </div>
    );
}

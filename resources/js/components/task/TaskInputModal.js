import React, { useState } from 'react';
import { TaskContainer } from './Task';

export default () => {
    const container = TaskContainer.useContainer();

    const [newTask, setNewTask] = useState({});

    const handleChange = () => {
        console.log(newTask.name);
    };

    return (
        <div className={`overlay ${container.isInputModal && "is-open"}`}>
            <div className="modal panel">
                <h3 className="panel-title">新規登録</h3>
                <form className="form is-horizontal" onSubmit={container.handleAdd}>
                    <div className="panel-body">
                        <div className="input-group">
                            <label className="form-label">件名</label>
                            <input type="text" name="title" className="form-input" />
                        </div>
                        <div className="input-group">
                            <label className="form-label">期日</label>
                            <input type="text" name="due_at" className="form-input date-time-input" />
                        </div>
                        <div className="input-group">
                            <label className="form-label">担当</label>
                            <div className="form-input">
                               <div className="select-box">
                                    <select name="user_id">
                                        <option>担当者</option>
                                        <option value="1">山田太郎</option>
                                        <option value="2">田中一郎</option>
                                        <option value="3">鈴木光一</option>
                                    </select>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div className="panel-footer">
                        <button className="btn is-primary">保存</button>
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

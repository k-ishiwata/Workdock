import React, { useContext } from 'react';
import Context from "./Context";
import axios from "axios";

export default () => {
    const context = useContext(Context);
    const [
        { isDeleteModal, task },
        dispatch
    ] = context.taskReducer;

    const handleSubmit = async e => {
        e.preventDefault();

        await axios
            .delete('/api/tasks/' + task.id)
            .then(response => {
                dispatch({
                    type: 'deleteTask',
                    payload: task
                });
                window.notice('データを削除しました。');
            })
            .catch(error => {
                window.notice('データの削除に失敗しました。', 'error');
            });
    };

    return (
        <div className={`overlay ${isDeleteModal && "is-open"}`}>
            <div className="modal panel">
                <h3 className="panel-title">削除確認</h3>
                <form className="form" onSubmit={handleSubmit}>
                    <div className="panel-body">
                        <p className="input-group align-center">
                            ID : {task.id}「{task.title}」<br />
                            を本当に削除しますか？
                        </p>
                    </div>
                    <div className="panel-footer">
                        <button className="btn is-pink">削除</button>
                        <a
                            className="btn close-btn"
                            onClick={() => {
                                dispatch({
                                    type: 'deleteModal',
                                    payload: {
                                        isDeleteModal: false
                                    }
                                })
                            }}>
                            キャンセル
                        </a>
                    </div>
                </form>
            </div>
        </div>
    );
}

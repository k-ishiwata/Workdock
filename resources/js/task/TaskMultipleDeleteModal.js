import React, { useContext } from 'react';
import Context from "./Context";
import axios from "axios";

export default () => {
    const context = useContext(Context);
    const [
        { isMultipleDeleteModal, selectTasks, status },
        dispatch
    ] = context.taskReducer;

    const handleSubmit = async e => {
        e.preventDefault();

        // idだけの配列にする
        const ids = selectTasks.map(t => t.id);

        await axios
            .delete('/api/tasks/deletes/' + ids)
            .then(response => {
                dispatch({
                    type: 'deleteTasks',
                    payload: ids
                });
                window.notice('データを削除しました。');
            })
            .catch(error => {
                window.notice('データの削除に失敗しました。', 'error');
            });
    };

    return (
        <div className={`overlay ${isMultipleDeleteModal && "is-open"}`}>
            <div className="modal panel">
                <h3 className="panel-title">削除確認</h3>
                <form className="form" onSubmit={handleSubmit}>
                    <div className="panel-body is-scroll">
                        { (selectTasks.length >= 1) ?
                            <div className="task-list" style={{height: '100%'}}>
                                <table className="table" style={{minWidth: '100%'}}>
                                    <tbody>
                                    {
                                        selectTasks.map(task => {
                                            return (
                                                <tr key={task.id}>
                                                    <td className="cell-id">{( '0000' + task.id ).slice( -4 )}</td>
                                                    <td className="cell-status">
                                                <span className={'label is-' + status[task.status_id].color}>
                                                    {status[task.status_id].label}
                                                </span>
                                                    </td>
                                                    <td>{task.title}</td>
                                                </tr>
                                            )
                                        })
                                    }
                                    </tbody>
                                </table>
                            </div> :
                            <div>削除するタスクを選択してください。</div>
                        }
                    </div>
                    <div className="panel-footer">
                        <button className="btn is-pink">削除</button>
                        <a
                            className="btn close-btn"
                            onClick={() => {
                                dispatch({
                                    type: 'multipleDeleteModal',
                                    payload: {
                                        isMultipleDeleteModal: false
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

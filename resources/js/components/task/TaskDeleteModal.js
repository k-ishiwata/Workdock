import React from 'react';
import { TaskContainer } from './Task';

export default () => {
    const container = TaskContainer.useContainer();

    return (
        <div className={`overlay ${container.isDeleteModal && "is-open"}`}>
            <div className="modal panel">
                <h3 className="panel-title">削除確認</h3>
                <form className="form" onSubmit={container.handleDelete}>
                    <div className="panel-body">
                        <p className="input-group align-center">
                            ID:{container.editTask.id} を本当に削除しますか？
                        </p>
                    </div>
                    <div className="panel-footer">
                        <button className="btn is-red">削除</button>
                        <a
                            className="btn close-btn"
                            onClick={() => container.setIsDeleteModal(false)}>
                            キャンセル
                        </a>
                    </div>
                </form>
            </div>
        </div>
    );
}

import React, { useContext } from 'react';
import Context from "./Context";

export default () => {
    const context = useContext(Context);
    const [
        { filterQuery, projects, status, users },
        dispatch
    ] = context.taskReducer;

    const handleChange = e => {
        const { name, value } = e.target;
        dispatch({
            type: 'setFilterQuery',
            payload: { ...filterQuery, [name]: value }
        });
    };

    return (
        <div className="search-panel toggle-block is-open">
            <h3 className="title toggle-btn">
                検索条件
            </h3>
            <div className="toggle-body">
                <form className="form">
                    <div className="input-group mb10">
                        <div className="status-select checkbox-btn-group">
                            <div className="checkbox-item">
                                <input
                                    type="radio"
                                    name="status_id"
                                    id="status-0"
                                    value="0"
                                    defaultChecked={true}
                                    onChange={handleChange}
                                />
                                <label htmlFor="status-0">完了以外</label>
                            </div>
                            {
                                status.map((item, index) => {
                                    if (index < 1) return;
                                    return (
                                        <div className="checkbox-item" key={index}>
                                            <input
                                                type="radio"
                                                name="status_id"
                                                id={'status-' + index}
                                                value={index}
                                                onChange={handleChange}
                                            />
                                            <label htmlFor={'status-' + index}>{ item.label }</label>
                                        </div>
                                    );
                                })
                            }
                        </div>
                    </div>

                    <div className="form-inline">
                        <div className="input-group">
                            <input type="text"
                                   placeholder="キーワード検索"
                                   name="title"
                                   onChange={handleChange}
                            />
                        </div>
                        <div className="input-group">
                            <div className="select-box" data-placeholder="プロジェクト選択">
                                <select
                                    name="project_id"
                                    value={filterQuery.project_id}
                                    onChange={handleChange}
                                >
                                    <option value="">プロジェクト選択</option>
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
                        <div className="input-group">
                            <div className="select-box">
                                <select
                                    name="user_id"
                                    value={filterQuery.user_id}
                                    onChange={handleChange}
                                >
                                    <option value="">担当者選択</option>
                                    {
                                        users.map((item) => {
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
                        <div className="input-group">
                            <input type="text" placeholder="期日" id="date-start-input" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    );
}

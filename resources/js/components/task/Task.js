import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import TaskList from './TaskList';
import TaskSearch from './TaskSearch';

// import axios from 'axios';
// import update from 'immutability-helper';

export default class Task extends Component {
    render() {
        return (
            <div>
                <TaskSearch />
                <div className="task-head">
                    <button className="btn is-sm is-icon" id="refresh-btn">
                        <i className="remixicon-refresh-line"></i>更新
                    </button>
                    <button className="btn is-sm is-icon is-orange" id="create-task-btn">
                        <i className="remixicon-add-circle-line"></i>新規登録
                    </button>
                </div>
                <TaskList />
            </div>
        );
    }
}


if (document.getElementById('task')) {
    ReactDOM.render(<Task />, document.getElementById('task'));
}


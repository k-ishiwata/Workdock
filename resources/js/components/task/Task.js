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
                <TaskList />
            </div>
        );
    }
}


if (document.getElementById('task')) {
    ReactDOM.render(<Task />, document.getElementById('task'));
}


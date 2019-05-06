import React, { Component } from 'react';
import ReactDOM from 'react-dom';
// import axios from 'axios';
// import update from 'immutability-helper';


export default class Task extends Component {
    render() {
        return (
            <div>
                タスク一覧
            </div>
        );
    }
}


if (document.getElementById('task')) {
    ReactDOM.render(<Task />, document.getElementById('task'));
}


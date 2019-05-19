import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { createContainer } from "unstated-next";
import useTask from './TaskContainer';

import TaskList from './TaskList';
import TaskSearch from './TaskSearch';
import TaskInput from './TaskInput';

// import axios from 'axios';
// import update from 'immutability-helper';

export const TaskContainer = createContainer(useTask);

/*
export default class Task extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isInputOpen: false
        };
    }

    handleInputPopup(isShow) {
        console.log(isShow);

        this.setState({
            isInputOpen: true
        });

    }

    render() {
        return (
            <div>
                <TaskSearch />
                <TaskList handleOpen={() => this.handleInputPopup()} />
                <TaskInput isShow={this.state.isInputOpen} />
            </div>
        );
    }
}
*/

const Task = () => {
    return (
        <TaskContainer.Provider>
            <TaskSearch />
            <TaskList />
            <TaskInput />
        </TaskContainer.Provider>
    );
};

if (document.getElementById('task')) {
    ReactDOM.render(<Task />, document.getElementById('task'));
}

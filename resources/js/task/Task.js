import React, { useReducer } from 'react';
import ReactDOM from 'react-dom';
import Context from './Context';
import TaskReducer from './TaskReducer';
import TaskList from './TaskList';
import TaskSearch from './TaskSearch';
import TaskInputModal from './TaskInputModal';
import TaskDeleteModal from './TaskDeleteModal';
import TaskMultipleDeleteModal from './TaskMultipleDeleteModal';
import TaskTimerModal from './TaskTimerModal';
import TaskState from './TaskState';

const Task = () => {
    const taskReducer = useReducer(TaskReducer, TaskState);

    return (
        <Context.Provider value={{taskReducer}}>
            <TaskSearch />
            <TaskList />
            <TaskInputModal />
            <TaskDeleteModal />
            <TaskMultipleDeleteModal />
            <TaskTimerModal />
        </Context.Provider>
    );
};

if (document.getElementById('task')) {
    ReactDOM.render(<Task />, document.getElementById('task'));
}

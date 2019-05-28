import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { createContainer } from "unstated-next";
import useTask from './TaskContainer';

import TaskList from './TaskList';
import TaskSearch from './TaskSearch';
import InputModal from './TaskInputModal';
import DeleteModal from './TaskDeleteModal';
import Alert from '../common/Alert';

export const TaskContainer = createContainer(useTask);

const Task = () => {
    return (
        <TaskContainer.Provider>
            <Alert />
            <TaskSearch />
            <TaskList />
            <InputModal />
            <DeleteModal />
        </TaskContainer.Provider>
    );
};

if (document.getElementById('task')) {
    ReactDOM.render(<Task />, document.getElementById('task'));
}

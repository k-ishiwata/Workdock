import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { createContainer } from "unstated-next";
import useTask from './TaskContainer';

import TaskList from './TaskList';
import TaskSearch from './TaskSearch';
import InputModal from './TaskInputModal';
import DeleteModal from './TaskDeleteModal';

// import update from 'immutability-helper';

export const TaskContainer = createContainer(useTask);

const Task = () => {
    return (
        <TaskContainer.Provider>
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

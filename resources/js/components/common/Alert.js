import React from 'react';
import { TaskContainer } from '../task/Task';

export default () => {
    const container = TaskContainer.useContainer();

    return (
        container.alert.isShow &&
        <div className={`alert is-${container.alert.status || ''}`}>
            <p>{container.alert.message}</p>
            <button className="close" onClick={() => container.setAlert({isShow: false})}>
                <span>&times;</span>
            </button>
        </div>
    );
}

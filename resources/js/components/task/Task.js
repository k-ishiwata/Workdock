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
                <div className="table-footer">
                    <ul className="pagination" role="navigation">
                        <li className="page-item disabled" aria-disabled="true" aria-label="« Previous">
                            <span className="page-link" aria-hidden="true">‹</span>
                        </li>
                        <li className="page-item active" aria-current="page"><span className="page-link">1</span></li>
                        <li className="page-item"><a className="page-link" href="#">2</a></li>
                        <li className="page-item"><a className="page-link" href="#">3</a></li>
                        <li className="page-item"><a className="page-link" href="#">4</a></li>
                        <li className="page-item"><a className="page-link" href="#">5</a></li>
                        <li className="page-item"><a className="page-link" href="#">6</a></li>
                        <li className="page-item"><a className="page-link" href="#">7</a></li>
                        <li className="page-item"><a className="page-link" href="#">8</a></li>

                        <li className="page-item disabled" aria-disabled="true"><span className="page-link">...</span>
                        </li>
                        <li className="page-item"><a className="page-link" href="#">19</a></li>
                        <li className="page-item"><a className="page-link" href="#">20</a></li>

                        <li className="page-item">
                            <a className="page-link" href="#" rel="next" aria-label="Next »">›</a>
                        </li>
                    </ul>
                </div>
            </div>
        );
    }
}


if (document.getElementById('task')) {
    ReactDOM.render(<Task />, document.getElementById('task'));
}


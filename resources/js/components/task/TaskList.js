import React, { Component } from 'react';
import axios from 'axios';

export default class TaskList extends Component {
    constructor() {
        super();

        this.state = {
            tasks: [],
            status: [
                {},
                {
                    label: '未着手',
                    color: null
                },{
                    label: '待機',
                    color: 'purple'
                },{
                    label: '進行中',
                    color: 'orange'
                },{
                    label: '完了',
                    color: 'green'
                }
            ],
            priority: [
                '高', '中', '低',
            ]
        };

        // this.handleClick = this.handleClick.bind(this);
    }
    async componentDidMount() {
        // fetch('/api/task')
        //     .then(response => {
        //         return response.json();
        //     })
        //     .then(response => {
        //         this.setState({
        //             tasks:response
        //         });
        //     });

        await axios
            .get('/api/tasks')
            .then(response => {
                const data = response.data;

                this.setState({
                    tasks: data
                });
            }).catch(error => {
                // this.setState({
                //     error: true
                // });
            });
    }
    render() {
        const list = this.state.tasks.map((task) => {
            return <tr key={task.id}>
                <td className="cell-do"><i className="remixicon-play-fill"></i></td>
                <td className="cell-status">
                    <span className={'label is-' + this.state.status[task.status_id].color}>{this.state.status[task.status_id].label}</span>
                </td>
                <td className={'cell-priority ' + (task.priority_id == 1 ? 'is-high' : null)}>{this.state.priority[task.priority_id-1]}</td>
                <td className="cell-title">{task.title}</td>
                <td><a href="#">坂田印刷</a></td>
                <td>17/02/20</td>
                <td>17/02/01</td>
                <td>{task.user.display_name}</td>
                <td>1:00</td>
                <td className="cell-action">
                    <a href="#" title="詳細"><i className="remixicon-file-text-line"></i></a>
                    <a href="#" title="編集"><i className="remixicon-file-edit-line"></i></a>
                </td>
            </tr>;
        });
        return (
            <div className="task-list">
                <table className="table is-stripe">
                    <thead>
                    <tr>
                        <th className="cell-do"></th>
                        <th className="cell-status">状態</th>
                        <th className="cell-priority">優先度</th>
                        <th className="cell-title">件名</th>
                        <th>プロジェクト</th>
                        <th>期日</th>
                        <th>登録日</th>
                        <th>担当</th>
                        <th>時間</th>
                        <th>アクション</th>
                    </tr>
                    </thead>
                    <tbody>
                    {list}
                    </tbody>
                </table>
            </div>
        );
    }
}

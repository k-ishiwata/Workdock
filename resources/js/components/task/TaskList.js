import React, { Component } from 'react';

export default class TaskList extends Component {
    render() {
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
                    <tr>
                        <td className="cell-do"><i className="remixicon-play-fill"></i></td>
                        <td className="cell-status"><span className="label is-purple">待機</span></td>
                        <td className="cell-priority">低</td>
                        <td className="cell-title">バナー作成</td>
                        <td><a href="#">坂田印刷</a></td>
                        <td>17/02/20</td>
                        <td>17/02/01</td>
                        <td>山田 太郎</td>
                        <td>1:00</td>
                        <td className="cell-action">
                            <a href="#" title="詳細"><i className="remixicon-file-text-line"></i></a>
                            <a href="#" title="編集"><i className="remixicon-file-edit-line"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        );
    }
}

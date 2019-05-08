import React, { Component } from 'react';

export default class TaskSearch extends Component {
    render() {
        return (
            <div className="search-panel toggle-block is-open">
                <h3 className="title toggle-btn">
                    検索条件
                </h3>
                <div className="toggle-body">
                    <form className="form">
                        <div className="input-group mb10">
                            <div className="status-select checkbox-btn-group">
                                <input type="radio" name="status-select" id="status-5" checked />
                                <label htmlFor="status-5">完了以外</label>
                                <input type="radio" name="status-select" id="status-1" />
                                <label htmlFor="status-1">未着手</label>
                                <input type="radio" name="status-select" id="status-2" />
                                <label htmlFor="status-2">待機</label>
                                <input type="radio" name="status-select" id="status-3" />
                                <label htmlFor="status-3">進行中</label>
                                <input type="radio" name="status-select" id="status-4" />
                                <label htmlFor="status-4">完了</label>
                            </div>
                        </div>

                        <div className="form-inline">
                            <div className="input-group">
                                <input type="text" placeholder="キーワード検索" />
                            </div>
                            <div className="input-group">
                                <div className="select-box" data-placeholder="プロジェクト選択">
                                    <select name="project">
                                        <option selected>プロジェクト選択</option>
                                        <option value="B">Workdock</option>
                                        <option value="O">ポータルサイト</option>
                                        <option value="AB">ランディングページ</option>
                                    </select>
                                </div>
                            </div>
                            <div className="input-group">
                                <div className="select-box">
                                    <select name="project">
                                        <option selected>担当者</option>
                                        <option value="A">山田太郎</option>
                                        <option value="B">田中一郎</option>
                                        <option value="O">鈴木光一</option>
                                    </select>
                                </div>
                            </div>
                            <div className="input-group">
                                <input type="text" placeholder="期日" id="date-start-input" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
}

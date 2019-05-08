@extends('layouts.app')
@section('content')
    <h1>Task</h1>



    <div id="l-container">
        <div id="task"></div>

        <div class="search-panel toggle-block is-open">
            <h3 class="title toggle-btn">
                検索条件
            </h3>
            <div class="toggle-body">
                <form class="form">
                    <div class="input-group mb10">
                        <div class="status-select checkbox-btn-group">
                            <input type="radio" name="status-select" id="status-5" checked><label for="status-5">完了以外</label>
                            <input type="radio" name="status-select" id="status-1"><label for="status-1">未着手</label>
                            <input type="radio" name="status-select" id="status-2"><label for="status-2">待機</label>
                            <input type="radio" name="status-select" id="status-3"><label for="status-3">進行中</label>
                            <input type="radio" name="status-select" id="status-4"><label for="status-4">完了</label>
                        </div>
                    </div>

                    <div class="form-inline">
                        <div class="input-group">
                            <input type="text" placeholder="キーワード検索">
                        </div>
                        <div class="input-group">
                            <div class="select-box" data-placeholder="プロジェクト選択">
                                <select name="project">
                                    <option selected>プロジェクト選択</option>
                                    <option value="B">Workdock</option>
                                    <option value="O">ポータルサイト</option>
                                    <option value="AB">ランディングページ</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="select-box">
                                <select name="project">
                                    <option selected>担当者</option>
                                    <option value="A">山田太郎</option>
                                    <option value="B">田中一郎</option>
                                    <option value="O">鈴木光一</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="期日" id="date-start-input">
                        </div>
                        <!-- <button class="btn">検索</button> -->
                    </div>
                </form>
            </div>
        </div>

        <div class="task-head">
            <!-- <p>全50件中1〜30件表示</p> -->
            <button class="btn is-sm is-icon" id="refresh-btn"><i class="remixicon-refresh-line"></i>更新</button>
            <button class="btn is-sm is-icon is-orange" id="create-task-btn"><i class="remixicon-add-circle-line"></i>新規登録</button>
        </div>
        <div class="task-list">
            <table class="table is-stripe">
                <thead>
                <tr>
                    <th class="cell-do"></th>
                    <th class="cell-status">状態</th>
                    <th class="cell-priority">優先度</th>
                    <th class="cell-title">件名</th>
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
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label is-purple">待機</span></td>
                    <td class="cell-priority">低</td>
                    <td class="cell-title">バナー作成</td>
                    <td><a href="#">坂田印刷</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>山田 太郎</td>
                    <td>1:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label">未着手</span></td>
                    <td class="cell-priority is-high">高</td>
                    <td class="cell-title">見積もり作成</td>
                    <td><a href="#">共済会病院</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>田中 幸一</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label is-orange">進行中</span></td>
                    <td class="cell-priority">低</td>
                    <td class="cell-title">デザインカンプ作成</td>
                    <td><a href="#">共済会病院</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>田中 幸一</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label is-green">完了</span></td>
                    <td class="cell-priority">中</td>
                    <td class="cell-title">トップメインバナー作成</td>
                    <td><a href="#">坂田印刷</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>山田 太郎</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label">未着手</span></td>
                    <td class="cell-priority">低</td>
                    <td class="cell-title">バナー作成</td>
                    <td><a href="#">坂田印刷</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>山田 太郎</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label">未着手</span></td>
                    <td class="cell-priority is-high">高</td>
                    <td class="cell-title">見積もり作成</td>
                    <td><a href="#">共済会病院</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>田中 幸一</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label is-purple">待機</span></td>
                    <td class="cell-priority">低</td>
                    <td class="cell-title">バナー作成</td>
                    <td><a href="#">坂田印刷</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>山田 太郎</td>
                    <td>1:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr class="doing">
                    <td class="cell-do"><i class="remixicon-stop-circle-line"></i></td>
                    <td class="cell-status"><span class="label">未着手</span></td>
                    <td class="cell-priority is-high">高</td>
                    <td class="cell-title">見積もり作成</td>
                    <td><a href="#">共済会病院</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>田中 幸一</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label is-orange">進行中</span></td>
                    <td class="cell-priority">低</td>
                    <td class="cell-title">デザインカンプ作成</td>
                    <td><a href="#">共済会病院</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>田中 幸一</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label is-green">完了</span></td>
                    <td class="cell-priority">中</td>
                    <td class="cell-title">トップメインバナー作成</td>
                    <td><a href="#">坂田印刷</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>山田 太郎</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label">未着手</span></td>
                    <td class="cell-priority">低</td>
                    <td class="cell-title">バナー作成</td>
                    <td><a href="#">坂田印刷</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>山田 太郎</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                <tr>
                    <td class="cell-do"><i class="remixicon-play-fill"></i></td>
                    <td class="cell-status"><span class="label">未着手</span></td>
                    <td class="cell-priority is-high">高</td>
                    <td class="cell-title">見積もり作成</td>
                    <td><a href="#">共済会病院</a></td>
                    <td>17/02/20</td>
                    <td>17/02/01</td>
                    <td>田中 幸一</td>
                    <td>0:00</td>
                    <td class="cell-action">
                        <a href="#" title="詳細"><i class="remixicon-file-text-line"></i></a>
                        <a href="#" title="編集"><i class="remixicon-file-edit-line"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div><!-- /.table-list-->

        <div class="table-footer">
            <ul class="pagination" role="navigation">
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li>
                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#">6</a></li>
                <li class="page-item"><a class="page-link" href="#">7</a></li>
                <li class="page-item"><a class="page-link" href="#">8</a></li>

                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                <li class="page-item"><a class="page-link" href="#">19</a></li>
                <li class="page-item"><a class="page-link" href="#">20</a></li>

                <li class="page-item">
                    <a class="page-link" href="#" rel="next" aria-label="Next »">›</a>
                </li>
            </ul>
        </div><!-- /.table-footer -->
    </div>

    <div class="overlay" id="input-task">
        <div class="modal panel">
            <h3 class="panel-title">新規登録</h3>
            <form class="form is-horizontal">
                <div class="panel-body">
                    <div class="input-group">
                        <label class="form-label">件名</label>
                        <input type="text" class="form-input">
                    </div>
                    <div class="input-group">
                        <label class="form-label">期日</label>
                        <input type="text" class="form-input date-time-input">
                    </div>
                    <div class="input-group">
                        <label class="form-label">担当</label>
                        <div class="form-input">
                            <div class="select-box">
                                <select name="project">
                                    <option selected>担当者</option>
                                    <option value="A">山田太郎</option>
                                    <option value="B">田中一郎</option>
                                    <option value="O">鈴木光一</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-body -->
                <div class="panel-footer">
                    <button class="btn is-primary">保存</button>
                    <a class="btn close-btn">キャンセル</a>
                </div>
            </form>
        </div><!-- /.modal -->
    </div><!-- /#input-task -->



@endsection

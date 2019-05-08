@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="task"></div>
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

<div id="delete-modal" class="overlay">
    <div class="modal panel">
        <h3 class="panel-title">削除確認</h3>
        <form method="POST" class="form" id="delete-form" action="{{ $url }}">
            @method('DELETE')
            @csrf
            <div class="panel-body">
                <p class="input-group align-center">
                    本当に削除しますか？
                </p>
            </div>
            <div class="panel-footer">
                <button class="btn is-pink">削除</button>
                <a class="btn close-btn">キャンセル</a>
            </div>
        </form>
    </div>
</div>

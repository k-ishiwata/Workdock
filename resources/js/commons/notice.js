// 更新時等メッセージを表示
(() => {
    // const notice = document.getElementById('notice');
    const notice = document.querySelector('#notice');
    const $message = notice.querySelector('#notice-message');

    // ボタンクリックで閉じる
    notice.querySelector('#notice-close-btn').addEventListener('click', (e) => {
        notice.setAttribute('data-show', false);
    });

    window.notice = (message, status = null) => {
        $message.innerText = message;

        notice.setAttribute('data-show', true);

        // classすべて削除
        notice.className = '';

        if (status) {
            notice.classList.add('is-' + status);
        }

        // 時間経過後閉じる
        setTimeout(()=> {
            notice.setAttribute('data-show', false);
        }, 3000);
    };
})();

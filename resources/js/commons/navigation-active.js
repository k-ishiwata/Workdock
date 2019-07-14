// 現在のナビゲーションをアクティブにする
(() => {
    let url = location.pathname;
    // 第一階層だけ取得
    url = url.split('/')[1];
    const navs = document.querySelectorAll('.header-nav a');

    navs.forEach(nav => {
        if ( nav.getAttribute('href').indexOf(url) === 1) {
            nav.parentNode.classList.add('is-active');
        }
    });
})();

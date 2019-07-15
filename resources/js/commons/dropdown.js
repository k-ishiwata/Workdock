// ドロップダウンメニュー
(() => {
    const navs = document.querySelectorAll('.dropdown');
    navs.forEach(nav => {
        nav.addEventListener('mouseenter', (e) => {
            nav.classList.add('is-open');
        });
        nav.addEventListener('mouseleave', (e) => {
            nav.classList.remove('is-open');
        });

    });
})();

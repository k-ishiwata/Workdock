// 削除時に確認ダイアログを表示
(() => {
    const deleteModal = document.getElementById('delete-modal');

    if (!deleteModal) return;

    const daleteBtns = document.querySelectorAll('.delete-btn');
    const submitBaseUrl = document.getElementById('delete-form').action;

    daleteBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const selectId = e.target.getAttribute('data-id');
            deleteModal.classList.add('is-open');
            deleteModal.querySelector('#delete-form').action = submitBaseUrl + '/' + selectId;
        });
    });

    deleteModal.querySelector('.close-btn').addEventListener('click', (e) => {
        deleteModal.classList.remove('is-open');
    });
})();

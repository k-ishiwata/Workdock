/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/task/Task');


// 削除モーダル
window.addEventListener('load', () => {
    (() => {
        const deleteModal = document.getElementById('delete-modal');

        if (!deleteModal) return;

        const daleteBtns = document.querySelectorAll('.delete-btn');
        const submiteBaseUrl = document.getElementById('delete-form').action;

        daleteBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const selectId = e.target.getAttribute('data-id');
                deleteModal.classList.add('is-open');
                deleteModal.querySelector('#delete-form').action = submiteBaseUrl + '/' + selectId;
            });
        });

        deleteModal.querySelector('.close-btn').addEventListener('click', (e) => {
            deleteModal.classList.remove('is-open');
        });
    })();

    // ナビゲーションのアクティブ



});

// 日付入力
import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja";
import 'flatpickr/dist/themes/light.css';

flatpickr('.data-input', {
    locale: Japanese,
    enableTime: true,
    dateFormat: "Y-m-d H:i:S"
    // defaultDate: "2019-06-01"
});

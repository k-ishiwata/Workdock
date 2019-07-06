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


require('./task/Task');

window.addEventListener('load', () => {
    require('./commons/notice');
    require('./commons/deleteModal');
});

// 日付入力
import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja";
import 'flatpickr/dist/themes/light.css';
//
flatpickr('.data-input', {
    locale: Japanese,
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    // altFormat: "Y-m-d H:i",
    allowInput: true
    // dateFormat: "Y-m-d H:i:S"
});

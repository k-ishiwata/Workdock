import flatpickr from "flatpickr";
import {Japanese} from "flatpickr/dist/l10n/ja";
import 'flatpickr/dist/themes/light.css';


(() => {

    // URLパラメータ取得
    function getQueryParam(key) {
        const value = window.location.href.match(new RegExp("[?&]" + key + "=(.*?)(&|$|#)"));
        if (value == null) return '';
        return decodeURIComponent(value[1]);
    }

    const path = location.pathname.split('/');

    if (path[1] === 'reports') {
        let dateOption = {
            locale: Japanese,
            dateFormat: "Y/m/d",
            allowInput: true,
            onChange: function (selectedDates, dateStr, instance) {
                location.href = '/' + path[1] + '/' +  path[2] + '/' + dateStr;
            }
        };
        // URLにdateがあればオプションに追加
        if (path[5]) {
            dateOption.defaultDate = path[3] + '/' + path[4] + '/' + path[5];
        } else {
            dateOption.defaultDate = new Date();
        }
        flatpickr('.data-input', dateOption);
    }


    flatpickr('.data-input-time', {
        locale: Japanese,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        // altFormat: "Y-m-d H:i",
        allowInput: true
        // dateFormat: "Y-m-d H:i:S"
    });

    // 範囲日付入力
    flatpickr('.data-range-input', {
        mode: "range",
        locale: Japanese,
        dateFormat: "Y-m-d",
        allowInput: true
    });
})();

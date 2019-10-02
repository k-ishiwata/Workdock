import React, { useContext } from 'react';
import Context from "./Context";
import axios from "axios";
import dayjs from 'dayjs';

/**
 * 作業の開始・終了確認モーダル
 */
export default () => {
    const context = useContext(Context);
    const [
        { isTimerModal, task, startAt },
        dispatch
    ] = context.taskReducer;

    const handleChange = e => {
        const { name, value } = e.target;

        let tmp = dayjs(startAt);

        switch (name) {
            case('hour'):
                tmp = tmp.hour(value);
                break;
            case('min'):
                tmp = tmp.minute(value);
                break;
        }

        // console.log(tmp.format('HH:mm'));

        dispatch({
            type: 'setStartAt',
            payload: { startAt: tmp }
        });
    };

    const handleSubmit = async e => {
        e.preventDefault();

        await axios
            .put('/api/tasks/timer/' + task.id, {
                start_at: dayjs(startAt).second(0).format('YYYY-MM-DD HH:mm:ss')
            })
            .then(response => {
                dispatch({
                    type: 'updateTask',
                    payload: response.data.data
                });

                response.data.data.start_at ?
                    window.notice('タイマーを開始しました。'):
                    window.notice('タイマーを停止しました。');

            })
            .catch(error => {
                window.notice(error.response.data, 'error');
            });

        dispatch({
            type: 'timerModal',
            payload: {
                isTimerModal: false,
                startAt: null
            }
        });

    };

    return (
        <div className={`overlay ${isTimerModal && "is-open"}`}>
            <div className="modal panel">
                <h3 className="panel-title">{ task.start_at ? '作業の停止' : '作業の開始' }</h3>
                <form className="form" onSubmit={handleSubmit}>
                    <div className="panel-body">
                        <div className="input-group align-center">
                            <p className="mb10">
                                { task.start_at ? '終了' : '開始' }
                                時間を入力してください。
                            </p>
                            <div className="l-row is-item-center centered w50">
                                <input
                                    type="number"
                                    max="24"
                                    className="input align-center"
                                    name="hour"
                                    value={ startAt ? dayjs(startAt).hour() : '' }
                                    onChange={handleChange}
                                />
                                <span>　:　</span>
                                <input
                                    type="number"
                                    max="59"
                                    className="input align-center"
                                    name="min"
                                    value={ startAt ? dayjs(startAt).minute() : '' }
                                    onChange={handleChange}
                                />
                            </div>
                        </div>
                    </div>
                    <div className="panel-footer">
                        <button className="btn is-primary">{ task.start_at ? '停止' : '開始' }</button>
                        <a
                            className="btn close-btn"
                            onClick={() => {
                                dispatch({
                                    type: 'timerModal',
                                    payload: {
                                        isTimerModal: false,
                                        startAt: null
                                    }
                                })
                            }}>
                            キャンセル
                        </a>
                    </div>
                </form>
            </div>
        </div>
    );
}

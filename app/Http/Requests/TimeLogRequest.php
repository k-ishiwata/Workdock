<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TimeLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:200'
        ];


        // 編集時は異なるバリデーションルールを適用する
        if ($request->method() === 'PUT') {

//            $startTimeHour = $request->start_time_hour;
//            $startTimeMin = $request->start_time_min;
//            $endTimeHour = $request->end_time_hour;
//            $endTimeMin = $request->end_time_min;

            return $rules + [
                'start_time_hour' => [
                    'required',
                    // 終了時間が開始時間以降であること
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->start_time_hour > $request->end_time_hour) {
                            return $fail('終了時間は開始時間以降にしてください。');
                        }
                        if (
                            $request->start_time_hour == $request->end_time_hour &&
                            $request->start_time_min > $request->end_time_min
                        ) {
                            return $fail('終了時間は開始時間以降にしてください。');
                        }
                    }
                ],
                'start_time_min' => 'required',
                'end_time_hour' => 'required',
                'end_time_min' => 'required',
            ];
        }

        return $rules;
    }

    public function attributes(){
        return [
            'start_time_hour' => '開始時',
            'start_time_min' => '開始分',
            'end_time_hour' => '終了時',
            'end_time_min' => '終了分',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title'    => 'required|max:200',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
//        $response['data']    = [];
//        $response['status']  = 'NG';
//        $response['summary'] = 'Failed validation.';
//        $response['errors']  = $validator->errors()->toArray();
        $response['errors']  = $validator->errors()->all();

        throw new HttpResponseException(
            response()->json( $response, 422 )
        );
    }
}

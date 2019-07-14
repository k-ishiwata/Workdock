<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rule = [
//            'name' => 'required|max:200|unique:users,name,' . $this->user->id,
            'name'    => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($this->user),
            ],
            'display_name' => 'required|string|max:200'
        ];

        // 新規登録時はパスワード必須
        if ($this->routeIs('users.store')) {
            $rule += [
                'password' => 'required|string|min:8|confirmed',
            ];
        }

        return $rule;
    }
}

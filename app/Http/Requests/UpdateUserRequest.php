<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|',//unique:users,email',
            'password' => ['nullable','confirmed', Password::min(6)->mixedCase()->numbers()->uncompromised()],
            'password_confirmation' => 'required_with:password'
        ];
    }

    /**
 * Сообщения об ошибках для определенных правил проверки.
 *
 * @return array
 */
    public function messages()
    {
        return [
            'name.required' => 'Поле name должно быть заполнено',
            'email.required' => 'Поле email должно быть заполнено',
            'email.email' => 'Поле должно быть адресом email',
            'email.uniqe' => 'Email должен быть уникальным',
            'password.confirmed' => 'Пароль не соответсвует',
        ];
    }


}

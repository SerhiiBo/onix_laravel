<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|min:5|max:150',
            'keywords' => 'nullable',
            'text' => 'required|min:10',
            'cover' => 'nullable|mimes:png,jpeg,gif'
            // если все форматы изображений то
            //'cover' => 'nullable|image'
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
            'title.required' => 'Поле должно быть заполнено',
            'title.min' => 'Минимальная длинна заголовка - 5 символов',
            'title.max' => 'Максимальная длинна заголовка - 150 символов',
            'text.required' => 'Поле text должно быть заполнено',
            'text.min' => 'Минимальная длинна поля text - 10 символов',
            'cover.required' => 'Допустимый формат изображений: png, jpeg, gif',
        ];
    }

}

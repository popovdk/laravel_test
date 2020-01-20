<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:5','max:255'],
            'questions' => 'array|required',
            'questions.*' => ['string', 'min:5','max:255']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Напишите заголовок формы',
            'title.string' => 'Заголовок формы должен быть строкой',
            'title.min' => 'Заголовок формы должен быть минимум из :min символов',
            'title.max' => 'заголовок формы не может быть больше :max символов',

            'questions.required' => 'Задайте хотя бы один вопрос',

            'questions.*.string' => 'Текст вопроса должен быть строкой',
            'questions.*.min' => 'Текст вопроса должен быть миниум из :min символов',
            'questions.*.max' => 'Текст вопроса должен быть не более :max символов'
        ];
    }
}

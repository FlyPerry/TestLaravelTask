<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации запроса.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'body' => 'required|string|max:255', // Проверка, что наличие тела комментария не пустое и не превышает 255 символов
            'commentable_id' => 'required|integer|exists:posts,id,video,id', // Проверка, что commentable_id является числом и существует в соответствующей таблице
            'commentable_type' => 'required|string|in:post,video', // Проверка, что тип является строкой и равен либо "post", либо "video"
        ];
    }

}

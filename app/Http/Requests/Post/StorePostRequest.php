<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $tagsRes = json_decode($this->tags, true);
        $this->merge(['tags' => $tagsRes]);

        return [
            'title' => 'required|string|max:100',
            'content' => 'required|string|max:300',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'status' => 'required|in:draft,published',
            'tags' => 'required|array|min:1|max:5',
        ];
    }
}

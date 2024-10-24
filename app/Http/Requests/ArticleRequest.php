<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $rules = [];
        if ($this->method() == 'GET') {
            $rules['id'] = 'numeric';
        }

        if ($this->method() == 'POST') {

            $rules['user_id'] = 'required';
            $rules['title'] = 'required';
            $rules['description'] = 'required';
            $rules['body'] = 'required';
            $rules['action'] = 'required|in:store,update,delete';
        }

        // if (request()->get('action') === 'store' || request()->action === 'update') {
        //     $rules['code'] = 'unique:brands,cd_brand';
        // }


        if ($this->method() == 'Delete') {
            $rules['id'] = 'required|numeric';
        }
        return $rules;
    }
}

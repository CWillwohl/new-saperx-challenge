<?php

namespace App\Http\Requests\PhoneBook;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdatePhoneBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     * */
    public function attributes()
    {
        return [
            'DDD'   => 'DDD',
            'name'  => 'nome',
            'city'  => 'cidade',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'DDD'   => ['required', 'integer', 'digits: 2'],
            'name'  => ['required', 'string', 'max:255'],
            'city'  => ['required', 'string', 'max:255'],
        ];
    }
}

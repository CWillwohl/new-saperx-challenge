<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'birthday'      => 'data de nascimento',
            'email'         => 'e-mail',
            'phone'         => 'telefone',
            'name'          => 'nome',
            'cpf'           => 'CPF',
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
            'birthday'      => ['required', 'date'],
            'email'         => ['required', 'email', 'max:255'],
            'phone'         => ['required', 'string', 'min:11', 'max:11'],
            'name'          => ['required', 'string', 'max:255'],
            'cpf'           => ['required', 'string', 'max:11', 'min:11'],
        ];
    }
}

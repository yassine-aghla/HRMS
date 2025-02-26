<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'department_id' =>[ 'required|exists:departments,id',],
            'phone' => ['nullable', 'string', 'max:15'], 
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], 
            'contract_type' => ['nullable', 'in:CDI,CDD,Stage,Freelance'],
        ];
    }
}

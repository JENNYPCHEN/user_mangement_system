<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
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
            'name' => 'required', 'min:5','max:10', Rule::unique('users', 'name')->ignore($this->user->id,'min:5','max:10'),
            'email' => 'required', 'email', Rule::unique('users', 'email')->ignore($this->user->id ?? 0),
            'password' => 'required|confirmed|min:5'
        ];
    }
}

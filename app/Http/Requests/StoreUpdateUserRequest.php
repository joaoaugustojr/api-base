<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ["PUT", "PATCH"]);

        return [
            "name" => [
                "required",
                "min:3",
                "max:255"
            ],
            "email" => [
                !$isUpdate ? "required" : "nullable",
                !$isUpdate ? Rule::unique('users') : Rule::unique('users')->ignore($this->user),
                "email",
                "max:255"
            ],
            "password" => [
                !$isUpdate ? "required" : "nullable",
                "min:6",
                "max:50"
            ]
        ];
    }
}

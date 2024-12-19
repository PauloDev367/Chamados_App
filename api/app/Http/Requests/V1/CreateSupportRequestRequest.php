<?php

namespace App\Http\Requests\V1;

use App\Enums\SupportRequestStatus;
use App\Enums\SupportRequestType;
use App\Enums\SupportRequestUrgency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateSupportRequestRequest extends FormRequest
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
        return [
            "title" => "required|max:255|min:10",
            "type" => ["required", new Enum(SupportRequestType::class)],
            "urgency" => ["required", new Enum(SupportRequestUrgency::class)],
            "message" => "required|min:10",
            "print" => [
                "nullable",
                "mimes:jpeg,png,jpg",
                "max:5048"
            ],
        ];
    }
}

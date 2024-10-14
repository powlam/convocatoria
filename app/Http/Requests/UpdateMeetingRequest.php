<?php

namespace App\Http\Requests;

use App\Models\Meeting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMeetingRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                Rule::unique(Meeting::class)->ignore($this->route()->parameter('meeting')->id),
                'max:255',
            ],
            'date' => 'required_with:time|nullable|date_format:Y-m-d',
            'time' => 'nullable|date_format:H:i',
            'where' => 'nullable|string|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'bail',


                Rule::unique(Course::class)->ignore($this->course),
            ],
            'detail'=> [
                'bail',


                Rule::unique(Course::class)->ignore($this->course),
            ],
            'price' => [
                'bail',

                Rule::unique(Course::class)->ignore($this.course),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'unique'   => ':attribute đã được dùng',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'detail' => 'Detail',
            'price' => 'Price',
        ];
    }
}

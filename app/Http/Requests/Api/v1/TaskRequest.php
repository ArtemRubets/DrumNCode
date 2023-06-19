<?php

namespace App\Http\Requests\Api\v1;

use App\Helpers\Enums\Task\TaskStatuses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TaskRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'status' => [new Enum(TaskStatuses::class)],
            'title' => ['required'],
            'priority' => ['required', 'integer'],
            'description' => ['required'],
            'subtasks' => ['nullable', 'array'],
            'subtasks.*' => ['exists:tasks,id'],
        ];
    }
}

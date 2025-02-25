<?php

namespace App\Http\Requests\VideoManagement\Video;

use App\Domains\User\Enums\RolesEnum;
use App\Domains\VideoManagement\Enums\VideoRatingEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:30', 'min:3'],
            'description' => ['nullable', 'string', 'max:500', 'min:3'],
            'duration' => ['nullable', 'integer'],
            'release_date' => ['nullable', 'date'],
            'rating' => ['nullable', 'string', Rule::in(VideoRatingEnum::names())],
            'category_id' => ['nullable', 'integer', Rule::exists('categories', 'id')],
            'genre_id' => ['nullable', 'integer', Rule::exists('genres', 'id')],
            'is_published' => ['nullable', 'boolean'],
        ];
    }
}

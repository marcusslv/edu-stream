<?php

namespace App\Http\Requests\VideoManagement\Video;

use App\Domains\User\Enums\RolesEnum;
use App\Domains\VideoManagement\Enums\VideoRatingEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVideoRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:30', 'min:3'],
            'description' => ['nullable', 'string', 'max:500', 'min:3'],
            'duration' => ['required', 'integer'],
            'release_date' => ['required', 'date'],
            'rating' => ['required', 'string', Rule::in(VideoRatingEnum::names())],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'genre_id' => ['required', 'integer', Rule::exists('genres', 'id')]
        ];
    }
}

<?php

namespace App\Http\Requests\VideoManagement\Video;

use App\Domains\User\Enums\RolesEnum;
use Illuminate\Foundation\Http\FormRequest;

class UploadVideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:mp4'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->user()->hasRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
    }
}

<?php

namespace App\Http\Requests\CastMember;

use App\Domains\Enums\RolesEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreCastMemberRequest extends FormRequest
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
            'name' => 'required|max:255',
            'role' => 'required|in:actor,director',
            'bio' => 'nullable'
        ];
    }
}

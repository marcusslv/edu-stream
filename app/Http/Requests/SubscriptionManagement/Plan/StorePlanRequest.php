<?php

namespace App\Http\Requests\SubscriptionManagement\Plan;

use App\Domains\User\Enums\RolesEnum;
use Illuminate\Foundation\Http\FormRequest;

class StorePlanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
            'features' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->user()->hasRole(RolesEnum::SUBSCRIPTION_ADMINISTRATOR->value);
    }
}

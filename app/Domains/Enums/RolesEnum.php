<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\Traits\EnumTrait;

enum RolesEnum: string implements EnumInterface
{
    use EnumTrait;

    case VIDEO_ADMINISTRATOR = 'video_administrator';
    case SUBSCRIPTION_ADMINISTRATOR = 'subscription_administrator';
    case CLIENT = 'client';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'VIDEO_ADMINISTRATOR' => 'Video Administrator',
                'SUBSCRIPTION_ADMINISTRATOR' => 'Subscription Administrator',
                'CLIENT' => 'Client'
            ],
            'es' => [
                'VIDEO_ADMINISTRATOR' => 'Administrador de Video',
                'SUBSCRIPTION_ADMINISTRATOR' => 'Administrador de Suscripción',
                'CLIENT' => 'Cliente'
            ],
            'pt_BR' => [
                'VIDEO_ADMINISTRATOR' => 'Administrador de Vídeo',
                'SUBSCRIPTION_ADMINISTRATOR' => 'Administrador de Assinaturas',
                'CLIENT' => 'Cliente'
            ]
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}

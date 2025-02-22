<?php

namespace App\Domains\VideoManagement\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\Traits\EnumTrait;

enum VideoRatingEnum: string implements EnumInterface
{
    use EnumTrait;

    case L = 'L';
    case TEN = '10';
    case TWELVE = '12';
    case FOURTEEN = '14';
    case SIXTEEN = '16';
    case EIGHTEEN = '18';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'L' => 'General Audience',
                '10' => 'Not recommended for children under 10',
                '12' => 'Not recommended for children under 12',
                '14' => 'Not recommended for children under 14',
                '16' => 'Not recommended for children under 16',
                '18' => 'Not recommended for children under 18',
            ],
            'es' => [
                'L' => 'Apto para todo público',
                '10' => 'No recomendado para menores de 10 años',
                '12' => 'No recomendado para menores de 12 años',
                '14' => 'No recomendado para menores de 14 años',
                '16' => 'No recomendado para menores de 16 años',
                '18' => 'No recomendado para menores de 18 años',
            ],
            'pt_BR' => [
                'L' => 'Livre para todos os públicos',
                '10' => 'Não recomendado para menores de 10 anos',
                '12' => 'Não recomendado para menores de 12 anos',
                '14' => 'Não recomendado para menores de 14 anos',
                '16' => 'Não recomendado para menores de 16 anos',
                '18' => 'Não recomendado para menores de 18 anos',
            ]
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}

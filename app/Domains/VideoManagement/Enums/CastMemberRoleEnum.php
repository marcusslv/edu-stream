<?php

namespace App\Domains\VideoManagement\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\Traits\EnumTrait;

enum CastMemberRoleEnum: string implements EnumInterface
{
    use EnumTrait;

    case ACTOR = 'actor';
    case DIRECTOR = 'director';
    case PRODUCER = 'producer';
    case SCREENWRITER = 'screenwriter';

    /**
     * @inheritDoc
     */
    public static function translations(string $locale = 'en'): array
    {
        $locations =  [
            'en' => [
                self::ACTOR->name => 'Actor',
                self::DIRECTOR->name => 'Director',
                self::PRODUCER->name => 'Producer',
                self::SCREENWRITER->name => 'Screenwriter',
            ],
            'pt' => [
                self::ACTOR->name => 'Ator',
                self::DIRECTOR->name => 'Diretor',
                self::PRODUCER->name => 'Produtor',
                self::SCREENWRITER->name => 'Roteirista',
            ],
            'es' => [
                self::ACTOR->name => 'Actor',
                self::DIRECTOR->name => 'Director',
                self::PRODUCER->name => 'Productor',
                self::SCREENWRITER->name => 'Guionista',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}

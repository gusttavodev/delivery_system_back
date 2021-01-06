<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DaysOfWeek extends Enum
{
    const Monday =   [
        'day' => 'monday',
        'label' => 'Segunda',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false
    ];
    const Tuesday =   [
        'day' => 'tuesday',
        'label' => 'Terça',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false
    ];
    const Wednesday =   [
        'day' => 'wednesday',
        'label' => 'Quarta',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false
    ];
    const Thursday =   [
        'day' => 'thursday',
        'label' => 'Quinta',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false
    ];
    const Friday =   [
        'day' => 'friday',
        'label' => 'Sexta',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false
    ];
    const Saturday =   [
        'day' => 'saturday',
        'label' => 'Sabado',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false
    ];
    const Sunday =   [
        'day' => 'sunday',
        'label' => 'Domingo',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false
    ];

    const List =   [
        self::Monday,
        self::Tuesday,
        self::Wednesday,
        self::Thursday,
        self::Friday,
        self::Saturday,
        self::Sunday
    ];
}

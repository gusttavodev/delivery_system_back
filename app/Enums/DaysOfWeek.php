<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DaysOfWeek extends Enum
{
    const monday =   [
        'day' => 'monday',
        'label' => 'Segunda',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false,
        'start_time_error' => false,
        'end_time_error' => false
    ];
    const tuesday =   [
        'day' => 'tuesday',
        'label' => 'Terça',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false,
        'start_time_error' => false,
        'end_time_error' => false
    ];
    const wednesday =   [
        'day' => 'wednesday',
        'label' => 'Quarta',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false,
        'start_time_error' => false,
        'end_time_error' => false
    ];
    const thursday =   [
        'day' => 'thursday',
        'label' => 'Quinta',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false,
        'start_time_error' => false,
        'end_time_error' => false
    ];
    const friday =   [
        'day' => 'friday',
        'label' => 'Sexta',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false,
        'start_time_error' => false,
        'end_time_error' => false
    ];
    const saturday =   [
        'day' => 'saturday',
        'label' => 'Sabado',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false,
        'start_time_error' => false,
        'end_time_error' => false
    ];
    const sunday =   [
        'day' => 'sunday',
        'label' => 'Domingo',
        'start_time' => null,
        'end_time' => null,
        'not_open' => false,
        'start_time_error' => false,
        'end_time_error' => false
    ];

    const List =   [
        self::monday,
        self::tuesday,
        self::wednesday,
        self::thursday,
        self::friday,
        self::saturday,
        self::sunday
    ];
}

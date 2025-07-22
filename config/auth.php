<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'api-admin' => [
            'driver' => 'token',
            'provider' => 'admins',
        ],

        'admin-store' => [
            'driver' => 'session',
            'provider' => 'stores',
        ],

        'api-admin-store' => [
            'driver' => 'token',
            'provider' => 'stores',
        ],

        'staff' => [
            'driver' => 'session',
            'provider' => 'staffs',
        ],

        'api-staff' => [
            'driver' => 'token',
            'provider' => 'staffs',
        ],

        'member' => [
            'driver' => 'session',
            'provider' => 'members',
        ],

        'api-member' => [
            'driver' => 'token',
            'provider' => 'member',
        ],

        'partner' => [
            'driver' => 'session',
            'provider' => 'partners',
        ],

        'api-partner' => [
            'driver' => 'token',
            'provider' => 'partner',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],

        'stores' => [
            'driver' => 'eloquent',
            'model' => App\AccountStore::class,
        ],

        'staffs' => [
            'driver' => 'eloquent',
            'model' => App\AccountStaff::class,
        ],

        'members' => [
            'driver' => 'eloquent',
            'model' => App\Member::class,
        ],

        'partners' => [
            'driver' => 'eloquent',
            'model' => App\PartnerShop::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 15,
        ],

        'stores' => [
            'provider' => 'stores',
            'table' => 'password_resets',
            'expire' => 15,
        ],

        'staffs' => [
            'provider' => 'staffs',
            'table' => 'password_resets',
            'expire' => 15,
        ],

        'members' => [
            'provider' => 'members',
            'table' => 'password_resets',
            'expire' => 15,
        ],

        'partners' => [
            'provider' => 'partners',
            'table' => 'password_resets',
            'expire' => 15,
        ],
    ],

];

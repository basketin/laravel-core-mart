<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OutMart configs
    |--------------------------------------------------------------------------
    */
    'database' => [
        'table_prefix' => 'outmart_'
    ],

    /*
    |--------------------------------------------------------------------------
    | Baskets configs
    |--------------------------------------------------------------------------
    */
    'baskets' => [
        'max_quote' => 10,

        'product_relation' => [
            'foreign_key' => 'sku',
            'model' => \OutMart\Models\Product::class,
        ],

        'observers' => null,

        'statuses' => [
            //
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Customers configs
    |--------------------------------------------------------------------------
    */
    'customers' => [
        'model' => \OutMart\Models\Customer::class,
        'observers' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Customers configs
    |--------------------------------------------------------------------------
    */
    'coupons' => [
        'conditions' => [
            //
        ]
    ],
];

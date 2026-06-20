<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Toast API credentials (optional)
    |--------------------------------------------------------------------------
    |
    | When client_id, client_secret, restaurant_guid, and merchant_uuid are
    | all set, checkout on this website uses live Toast API payments.
    | Otherwise use TOAST_ONLINE_ORDER_URL so guests pay on Toast's site.
    |
    */

    'client_id' => env('TOAST_CLIENT_ID'),
    'client_secret' => env('TOAST_CLIENT_SECRET'),
    'restaurant_guid' => env('TOAST_RESTAURANT_GUID'),
    'merchant_uuid' => env('TOAST_MERCHANT_UUID'),
    'api_hostname' => env('TOAST_API_HOSTNAME', 'ws-api.toasttab.com'),

    'card_encryption_key' => env('TOAST_CARD_ENCRYPTION_KEY'),
    'card_encryption_key_id' => env('TOAST_CARD_ENCRYPTION_KEY_ID'),

    'dining_option_delivery_guid' => env('TOAST_DINING_OPTION_DELIVERY_GUID'),
    'dining_option_pickup_guid' => env('TOAST_DINING_OPTION_PICKUP_GUID'),
    'revenue_center_guid' => env('TOAST_REVENUE_CENTER_GUID'),
    'gift_card_menu_item_guid' => env('TOAST_GIFT_CARD_MENU_ITEM_GUID'),

    /*
    |--------------------------------------------------------------------------
    | Toast online ordering page
    |--------------------------------------------------------------------------
    |
    | When set, the public /menu route and "Order Online" links send guests to
    | Toast's hosted menu instead of the built-in website menu.
    |
    */

    'online_order_url' => env('TOAST_ONLINE_ORDER_URL'),

    /*
    |--------------------------------------------------------------------------
    | Toast eGift card page
    |--------------------------------------------------------------------------
    |
    | When set, the public /gift-cards route sends guests to Toast's hosted
    | gift card purchase page instead of the built-in website form.
    |
    */

    'gift_card_url' => env('TOAST_GIFT_CARD_URL'),

];

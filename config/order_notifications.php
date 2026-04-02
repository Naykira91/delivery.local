<?php

return [
    'manager_email' => env('ORDER_MANAGER_EMAIL'),

    'vk' => [
        'enabled' => env('ORDER_VK_ENABLED', false),
        'group_id' => env('ORDER_VK_GROUP_ID'),
        'token' => env('ORDER_VK_TOKEN'),
        'peer_id' => env('ORDER_VK_PEER_ID'), // кому шлём: user/chat peer_id
        'api_version' => env('ORDER_VK_API_VERSION', '5.199'),
        'timeout' => env('ORDER_VK_TIMEOUT', 10),
    ],
];

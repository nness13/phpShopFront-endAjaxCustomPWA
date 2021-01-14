<?php

return [
	// MainController
    '\?fbclid={option:.+}' => [
        'controller' => 'main',
        'action' => 'portfolio',
    ],
    'trands' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    '' => [
        'controller' => 'main',
        'action' => 'home',
    ],
    'about' => [
        'controller' => 'main',
        'action' => 'about',
    ],
    'services/info' => [
        'controller' => 'main',
        'action' => 'services',
    ],
    'selfie_stick' => [
        'controller' => 'main',
        'action' => 'selfie_stick',
    ],
    'grip_go' => [
        'controller' => 'main',
        'action' => 'grip_go',
    ],
//    '' => [
//        'controller' => 'main',
//        'action' => 'redirect_to_catalog',
//    ],

    // MediaJeen
    'mediajeen' => [
        'controller' => 'mediajeen',
        'action' => 'main',
    ],
    'transport_tv' => [
        'controller' => 'mediajeen',
        'action' => 'transporttv',
    ],
    'transport_routes/{option:\w+}/{page:\d+}/{sorting:\w+}/{itemsort:\w+}' => [
        'controller' => 'mediajeen',
        'action' => 'transportroutes',
    ],
    'transport_route/add' => [
        'controller' => 'mediajeen',
        'action' => 'transportRouteAdd',
    ],
    'media/add' => [
        'controller' => 'mediajeen',
        'action' => 'newAdvertisements',
    ],
    'media/view' => [
        'controller' => 'mediajeen',
        'action' => 'view',
    ],
    'api/media/viewpayapi' => [
        'controller' => 'mediajeen',
        'action' => 'viewpayapi',
    ],
    // ShopController
    'catalog/{option:\w+}/{page:\d+}/{sorting:\w+}/{itemsort:\w+}' => [
        'controller' => 'shop',
        'action' => 'catalog',
    ],
    'new/goods' => [
        'controller' => 'shop',
        'action' => 'newGoods',
    ],
    'goods/{id:\d+}' => [
        'controller' => 'shop',
        'action' => 'goods',
    ],
    'goods/edit/{id:\d+}' => [
        'controller' => 'shop',
        'action' => 'editGoods',
    ],
    // AccountController
    'account/settings' => [
        'controller' => 'account',
        'action' => 'settings',
    ],
    'account/user_history/{id:\d+}' => [
        'controller' => 'account',
        'action' => 'history',
    ],
    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],
    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],
    'account/recovery' => [
        'controller' => 'account',
        'action' => 'recovery',
    ],
    'account/confirm' => [
        'controller' => 'account',
        'action' => 'confirm',
    ],
    'account/confirm/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'confirm',
    ],
    'account/reset/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'reset',
    ],
    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],
    // KassaController
    'kassa' => [
        'controller' => 'kassa',
        'action' => 'main',
    ],
    'kassa/{option:.+}' => [
        'controller' => 'kassa',
        'action' => 'main',
    ],
    // ApiController
    'api/category' => [
        'controller' => 'api',
        'action' => 'category',
    ],
    'adsline' => [
        'controller' => 'api',
        'action' => 'adsline',
    ],
    'api/getcounties' => [
        'controller' => 'api',
        'action' => 'getCounties',
    ],
];


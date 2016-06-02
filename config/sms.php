<?php
/**
 * this source file is sms.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-01 16-39
 */
return [
    // 短信发送策略single, multi
    'tactics' => 'single',

    'channel' => [
        // 云片
        'yun_pian' => [
            // api key
            'api_key' => '',
            // 默认发送渠道
            'default' => true,
            // tactics=multi时生效
            'weight'  => 1
        ],
    ]
];
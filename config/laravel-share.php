<?php 

return [
    'services' => [
        'facebook' => [
            'uri' => 'https://www.facebook.com/sharer/sharer.php?u=',
        ],
        'twitter' => [
            'uri' => 'https://twitter.com/intent/tweet',
            'text' => 'Default share text',
        ],
        'linkedin' => [
            'uri' => 'https://www.linkedin.com/sharing/share-offsite', // oud: http://www.linkedin.com/shareArticle
            'extra' => ['mini' => 'true'],
        ],
        'whatsapp' => [
            'uri' => 'https://wa.me/?text=',
            'extra' => ['mini' => 'true'],
        ],
        'pinterest' => [
            'uri' => 'https://pinterest.com/pin/create/button/?url=',
        ],
        'reddit' => [
            'uri' => 'https://www.reddit.com/submit',
            'text' => 'Default share text',
        ],
        'telegram' => [
            'uri' => 'https://telegram.me/share/url',
            'text' => 'Default share text',
        ],
    ],
]

?>
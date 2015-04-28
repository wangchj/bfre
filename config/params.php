<?php

return [
    'adminEmail' => 'admin@example.com',
    'phone'=>'',
    'sendgrid' => [
        'username' => '',
        'password' => ''
    ],
    'contact' => [
        'sender' => 'sender@example.com', //Contact emails will be sent on behalf of this address
        'receivers' => [                //Receivers of contact emails
            'receiver1@example.com',
            'receiver2@example.com'
        ]
    ]
];

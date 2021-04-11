<?php
return array(
    'company_status' => [
        1 => 'Hot',
        2 => 'Cold',
    ],

    'company_sub_status' => [
        1 => 'Close',
        2 => 'Cancelled',
        3 => 'In Progress',
    ],

    'permissions' => [
        'company' => [
            'full_access',
            'read',
            'read_write',
            'delete',
        ],
        'company_staff' => [
            'full_access',
            'read',
            'read_write',
            'delete',
        ],
        'user' => [
            'full_access',
            'read',
            'read_write',
            'delete',
        ],
    ],

);
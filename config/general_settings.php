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
                'full_access' => true,
                'read' => true,
                'read_write' => true,          
            ],
            // 'company_staff' => [
            //     'full_access',
            //     'read',
            //     'read_write',            
            // ],
            'user' => [
                'full_access' => true,
                'read' => true,
                'read_write' => true,
            ],
            'logs' => [
                'full_access' => true,
                'read' => false,
                'read_write' => false,
            ],
    ],

);
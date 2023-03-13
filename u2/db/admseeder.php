<?php

$users = [
    ['name' => 'briedis@gmail.com', 'psw' => md5('20230313')],
    ['name' => 'liutas@gmail.com', 'psw' => md5('20230313')],
    ['name' => 'krokodilas@gmail.com', 'psw' => md5('20230313')],
];

file_put_contents(__DIR__ . '/users.json', json_encode($users));

echo 'All Ok';


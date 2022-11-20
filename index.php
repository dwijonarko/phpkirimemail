<?php

use Dwijonarko\PHPKirimemail\KontakApi;
use Dwijonarko\PHPKirimemail\Lists;
use Dotenv\Dotenv;
use Dwijonarko\PHPKirimemail\Subscribers;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$kirimemail = new KontakApi();
$config = [
  'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
  'username' => $_ENV['KIRIMEMAIL_USERNAME']
];

$subscribers = new Subscribers($config);
$subscriber_param = [
  'email' => 'fromapi@dudu.web.id',
  'full_name' => 'Dudu',
  'lists' => 115,
  'status' => 'subscribed',
  'tags' => 'api,php',
  'fields' => [
    'phone' => '081234567890',
    'address' => 'Jl. Jalan'
  ]
];
var_dump($subscribers->getById(10240));
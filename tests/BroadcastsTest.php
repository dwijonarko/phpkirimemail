<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use Dwijonarko\PHPKirimemail\Broadcasts;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

final class BroadcastsTest extends TestCase
{
    private $config;
    private $broadcasts;
    private $broadcast_param;

    public function __construct()
    {
        parent::__construct();

        $this->config = [
            'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
            'username' => $_ENV['KIRIMEMAIL_USERNAME']
        ];
        $this->broadcasts = new Broadcasts($this->config);
        $this->broadcast_param = [];
    }

    public function testCanGetAll()
    {
        $result = $this->broadcasts->getAll();
        var_dump($result);
        $this->assertContains('success', json_decode($result, true));
    }

    public function testCanGetByGuid()
    {
        $broadcasts = $this->broadcasts->getAll();
        $arr_broadcasts = json_decode($broadcasts, true);
        $guid = $arr_broadcasts['data'][0]['guid'];
        $result = $this->broadcasts->getByGuid($guid);
        var_dump($result);
        $this->assertContains('success', json_decode($result, true));
    }   
}

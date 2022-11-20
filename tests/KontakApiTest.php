<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use Dwijonarko\PHPKirimemail\KontakApi;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

final class KontakApiTest extends TestCase
{
    private $config;
    private $kirimemail;

    public function __construct()
    {
        parent::__construct();
        $this->kirimemail = new KontakApi();
        $this->config = [
            'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
            'username' => $_ENV['KIRIMEMAIL_USERNAME']
        ];
    }
    public function testCanSetConfig()
    {
        $this->assertNull($this->kirimemail->setConfig($this->config));
    }

    public function testCanGenerateToken()
    {
        $this->kirimemail->setConfig($this->config);
        $this->assertIsString($this->kirimemail->generateToken());
    }
}

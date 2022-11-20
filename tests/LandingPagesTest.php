<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Dwijonarko\PHPKirimemail\LandingPages;
use PHPUnit\Framework\TestCase;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

final class LandingPagesTest extends TestCase
{
    private $config;
    private $landing_pages;

    public function __construct()
    {
        parent::__construct();

        $this->config = [
            'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
            'username' => $_ENV['KIRIMEMAIL_USERNAME']
        ];
        $this->landing_pages = new LandingPages($this->config);
    }

    public function testCanGetAll()
    {
        $result = $this->landing_pages->getAll();
        $this->assertContains('success', json_decode($result, true));
    }

    public function testCanGetById()
    {
        $landing_pages = $this->landing_pages->getAll();
        $arr_landing_pages = json_decode($landing_pages, true);
        $id = $arr_landing_pages['data'][0]['id'];
        $result = $this->landing_pages->getById($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanGetByUrl()
    {
        $landing_pages = $this->landing_pages->getAll();
        $arr_landing_pages = json_decode($landing_pages, true);
        $url = $arr_landing_pages['data'][0]['url'];
        $parse_url = parse_url($url, PHP_URL_PATH);
        if (!empty($parse_url)) {
            $path = explode('/', $parse_url);
            $landing_page_url = end($path);
        }else{
            $landing_page_url = $url;
        }
        $result = $this->landing_pages->getByUrl($landing_page_url);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }
}

<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Dwijonarko\PHPKirimemail\Forms;
use PHPUnit\Framework\TestCase;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

final class FormsTest extends TestCase
{
    private $config;
    private $forms;

    public function __construct()
    {
        parent::__construct();

        $this->config = [
            'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
            'username' => $_ENV['KIRIMEMAIL_USERNAME']
        ];
        $this->forms = new Forms($this->config);
    }

    public function testCanGetAll()
    {
        $result = $this->forms->getAll();
        $this->assertContains('success', json_decode($result, true));
    }

    public function testCanGetById()
    {
        $forms = $this->forms->getAll();
        $arr_forms = json_decode($forms, true);
        $id = $arr_forms['data'][0]['id'];
        $result = $this->forms->getById($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanGetByUrl()
    {
        $forms = $this->forms->getAll();
        $arr_forms = json_decode($forms, true);
        $url = $arr_forms['data'][0]['url'];
        $parse_url = parse_url($url, PHP_URL_PATH);
        if (!empty($parse_url)) {
            $path = explode('/', $parse_url);
            $form_url = end($path);
        }else{
            $form_url = $url;
        }
        $result = $this->forms->getByUrl($form_url);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }
}

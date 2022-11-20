<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use Dwijonarko\PHPKirimemail\Lists;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

final class ListsTest extends TestCase
{
    private $config;
    private $lists;
    private $list_param;

    public function __construct()
    {
        parent::__construct();

        $this->config = [
            'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
            'username' => $_ENV['KIRIMEMAIL_USERNAME']
        ];
        $this->lists = new Lists($this->config);
        $this->list_param = [
            'name' => 'Test List',
        ];
    }

    public function testCanGetAll()
    {
        $result = $this->lists->getAll();
        $this->assertContains('success', json_decode($result, true));
    }

    public function testCanGetById()
    {
        $lists = $this->lists->getAll();
        $arr_lists = json_decode($lists, true);
        $id = $arr_lists['data'][0]['id'];
        $result = $this->lists->getById($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanCreateList()
    {
        $result = $this->lists->create($this->list_param['name']);
        $id = json_decode($result, true)['data']['id'];
        $this->lists->delete($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanUpdateList()
    {
        $list = $this->lists->create($this->list_param['name']);
        $id = json_decode($list, true)['data']['id'];
        $result = $this->lists->update($id, $this->list_param['name']);
        $this->lists->delete($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanDeleteList()
    {
        $list = $this->lists->create($this->list_param['name']);
        $id = json_decode($list, true)['data']['id'];
        $result = $this->lists->delete($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }
}

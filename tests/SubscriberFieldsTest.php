<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Dwijonarko\PHPKirimemail\SubscriberFields;
use PHPUnit\Framework\TestCase;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

final class SubscriberFieldsTest extends TestCase
{
    private $config;
    private $subscriber_fields;
    private $subscriber_field_param;

    public function __construct()
    {
        parent::__construct();

        $this->config = [
            'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
            'username' => $_ENV['KIRIMEMAIL_USERNAME']
        ];
        $this->subscriber_fields = new SubscriberFields($this->config);
        $this->subscriber_field_param = [
            'name' => 'Nomor Telepon',
            'type' => 'text',
        ];
    }

    public function testCanGetAll()
    {
        $result = $this->subscriber_fields->getAll();
        $this->assertContains('success', json_decode($result, true));
    }

    public function testCanGetById()
    {
        $subscriber_fields = $this->subscriber_fields->getAll();
        $arr_subscriber_fields = json_decode($subscriber_fields, true);
        $id = $arr_subscriber_fields['data'][0]['id'];
        $result = $this->subscriber_fields->getById($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanCreateSubscriberField()
    {
        $result = $this->subscriber_fields->create($this->subscriber_field_param);
        $id = json_decode($result, true)['data']['id'];
        $this->subscriber_fields->delete($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanUpdateSubscriberField()
    {
        $result = $this->subscriber_fields->create($this->subscriber_field_param);
        $id = json_decode($result, true)['data']['id'];
        $subscriber_field_param = [
            'name' => 'Nomor Telepon Yang Diupdate', 'type' => 'text',
        ];
        $result = $this->subscriber_fields->update($id, $subscriber_field_param);
        $this->subscriber_fields->delete($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanDeleteSubscriberField()
    {
        $result = $this->subscriber_fields->create($this->subscriber_field_param);
        $id = json_decode($result, true)['data']['id'];
        $result = $this->subscriber_fields->delete($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }
}

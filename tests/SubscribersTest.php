<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use Dwijonarko\PHPKirimemail\Lists;
use Dwijonarko\PHPKirimemail\Subscribers;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

final class SubscribersTest extends TestCase
{
    private $config;
    private $subscriber;
    private $subscriber_param;
    private $lists;

    public function __construct()
    {
        parent::__construct();

        $this->config = [
            'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
            'username' => $_ENV['KIRIMEMAIL_USERNAME']
        ];
        $this->lists = new Lists($this->config);
        $lists = $this->lists->getAll();
        $arr_lists = json_decode($lists, true);
        $list_id = end($arr_lists['data'])['id'];

        $this->subscriber = new Subscribers($this->config);
        $this->subscriber_param = [
            'email' => 'fakeemail@dudu.web.id',
            'full_name' => 'Dudu',
            'lists' => $list_id,
            'status' => 'subscribed',
            'tags' => 'api,php',
            'fields' => [
                'phone' => '081234567890',
                'address' => 'Jl. Jalan'
            ]
        ];
    }

    public function testCanGetAll()
    {
        $result = $this->subscriber->getAll();
        $this->assertContains('success', json_decode($result, true));
    }

    public function testCanGetById()
    {
        $subscriber = $this->subscriber->getAll();
        $arr_subscriber = json_decode($subscriber, true);
        $id = $arr_subscriber['data'][0]['id'];
        $result = $this->subscriber->getById($id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanGetByEmail()
    {
        $subscriber = $this->subscriber->getAll();
        $arr_subscriber = json_decode($subscriber, true);
        $email = $arr_subscriber['data'][0]['email'];
        $result = $this->subscriber->getByEmail($email);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanCreateSubscriber()
    {
        $result = $this->subscriber->create($this->subscriber_param);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanUpdateSubscriber()
    {
        $subscriber = $this->subscriber->create($this->subscriber_param);
        $id = json_decode($subscriber, true)['data']['id'];
        $result = $this->subscriber->update($id, $this->subscriber_param);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanUpdateSubscriberEmail()
    {
        $subscriber = $this->subscriber->create($this->subscriber_param);
        $email = json_decode($subscriber, true)['data']['email'];
        $result = $this->subscriber->updateByEmail($email, $this->subscriber_param);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }

    public function testCanDeleteSubscriber()
    {
        $subscriber = $this->subscriber->create($this->subscriber_param);
        $id = json_decode($subscriber, true)['data']['id'];
        $list_id = json_decode($subscriber, true)['data']['list'][0]['id'];
        $result = $this->subscriber->delete($id, $list_id);
        $this->assertEquals(200, json_decode($result, true)['code']);
    }
}

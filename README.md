# PHP Class for Kirimemail Marketing API
The unofficial PHP client library for the [Kirim.Email](https://kirim.email) Marketing API. Official documentation for Kirim.Email Marketing api is [here](https://documenter.getpostman.com/view/23706886/2s83zduQge)

## Instalation
### Option 1: Install via Packagist (TBA)
### Option 2: Install Manually
Clone the repo

    git clone git@github.com:dwijonarko/phpkirimemail.git
In the client library project root, install all dependencies

    composer install
 Manually include `vendor/autoload.php` in your implementation

## Quick Start

   

     <?php
    
    use Dwijonarko\PHPKirimemail\KontakApi;
    use Dwijonarko\PHPKirimemail\Lists;
    use Dotenv\Dotenv;
    use Dwijonarko\PHPKirimemail\Subscribers;
    
    require_once 'vendor/autoload.php';
    
    //if you use .env
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    //create config array
    $config = [
      'api_token' => $_ENV['KIRIMEMAIL_TOKEN'],
      'username' => $_ENV['KIRIMEMAIL_USERNAME']
    ];
    
    //create subscriber instance with config
    $subscribers = new Subscribers($config);
    var_dump($subscribers->getAll());

## Functions
### List
 1. Get All Lists
```
$lists = new Lists($config);
$result = $lists->getAll();
```
 2. Get List By Id
```
$lists = new Lists($config);
$result = $lists->getById($listID);
```
 3. Create List
```
$lists = new Lists($config);
$list_name = 'List Name';
$result = $lists->create($list_name);
```

 5. Update List
```
$lists = new Lists($config);
$list_name = "Update Name";
$result = $lists->update($list_id,$list_name);
```

 6. Delete List
 ```
$lists = new Lists($config);
$result = $lists->delete($list_id);
```
 
### Subscriber
 1. Get All Subscriber
```
$subscribers = new Subscribers($config);
$result = $subscribers->getAll();
```
 2. Get Subscriber By Id
```
$subscribers = new Subscribers($config);
$result = $subscribers->getById($id);
```

 3. Get Subscriber By Email
 ```
$subscribers = new Subscribers($config);
$result = $subscribers->getByEmail($subscriber_email);
```

 4. Create Subscriber
```
$subscribers = new Subscribers($config);
$subscriber_params = [
	'email'  =>  'email@example.com',
	'full_name'  =>  'Full Name',
	'lists'  => $list_id,
	'status'  =>  'subscribed',
	'tags'  =>  'api,php',
	'fields'  => [
		'phone'  =>  '081234567890',
		'address'  =>  'Jl. Jalan'
	]]
$result = $subscribers->create($subscriber_params);
```

 5. Update Subscriber By Id
```
$subscribers = new Subscribers($config);
$subscriber_params = [
	'email'  =>  'email@example.com',
	'full_name'  =>  'Full Name',
	'lists'  => $list_id,
	'status'  =>  'subscribed',
	'tags'  =>  'api,php',
	'fields'  => [
		'phone'  =>  '081234567890',
		'address'  =>  'Jl. Jalan'
	]]
$result = $subscribers->update($subscriber_id,$subscriber_params);
```

 6. Update Subscriber By Email
```
$subscribers = new Subscribers($config);
$subscriber_params = [
	'email'  =>  'email@example.com',
	'full_name'  =>  'Full Name',
	'lists'  => $list_id,
	'status'  =>  'subscribed',
	'tags'  =>  'api,php',
	'fields'  => [
		'phone'  =>  '081234567890',
		'address'  =>  'Jl. Jalan'
	]]
$result = $subscribers->updateByEmail($subscriber_email,$subscriber_params);
```

 7. Delete Subscriber
```
$subscribers = new Subscribers($config);
$result = $subscribers->getAll();
```

### Subscriber Field
 1. Get All Subscriber Field
```
$subscriber_field = new SubscriberFields($config);
$result = $subscriber_field->getAll();
```
 2. Get Subscriber Field By Id
```
$subscriber_field = new SubscriberFields($config);
$result = $subscriber_field->getById($subsciber_field_id);
```
 3. Create Subscriber Field
```
$subscriber_field = new SubscriberFields($config);
$subscriber_field_param = [
	'name' => 'Address',
    'type' => 'textarea',
];
$result = $subscriber_field->create($subscriber_field_param);
```
 4. Update Subscriber Field
```
$subscriber_field = new SubscriberFields($config);
$subscriber_field_param = [
	'name' => 'Address',
    'type' => 'textarea',
];
$result = $subscriber_field->updpate($id,$subscriber_field_param);
```

 5. Delete Subscriber Field	
```
$subscriber_field = new SubscriberFields($config);
$result = $subscriber_field->delete($subscriber_field_id);
```

### Form

 1. Get All Form
```
$form = new Forms($config);
$result = $form->getAll();
```
 2. Get Form By Id
```
$form = new Forms($config);
$result = $form->getById($form_id);
```
 3. Get Form By Url
```
$form = new Forms($config);
$parse_url = parse_url($url, PHP_URL_PATH);
if (!empty($parse_url)) {
	$path = explode('/', $parse_url);
    $form_url = end($path);
}else{
	$form_url = $url;
}
$result = $form->getByUrl($form_url);
```
### Landing Page

 1. Get All Landing Page
```
$landing = new LandingPages($config);
$result = $landing->getAll();
```
 2. Get Landing Page By Id
```
$landing = new LandingPages($config);
$result = $landing->getById($form_id);
```
 3. Get Landing Page By Url
```
$landing = new LandingPages($config);
$parse_url = parse_url($url, PHP_URL_PATH);
if (!empty($parse_url)) {
	$path = explode('/', $parse_url);
    $form_url = end($path);
}else{
	$form_url = $url;
}
$result = $landing->getByUrl($form_url);
```
### Broadcast

 1. Get All Broadcast
```
$broadcast = new Broadcasts($config);
$result = $broadcast->getAll();
```
 2. Get Broadcast By GUID
```
$broadcast = new Broadcasts($config);
$result = $broadcast->getByGuid($broadcast_guid);
```
 3. Create Broadcast
**Note:** The message contains the subject and content. You can send a maximum of 3 messages.
```
$broadcast = new Broadcasts($config);
$param[
	'title'=>'Title',
	'sender'=>'Email Sender',
	'messages[0][subject]'=>'Email Subject',
	'messages[0]['content]'=>'Email content, ', //disallow css and js, read official docs for detail
	'send_at'=>'2018-12-30 00:00:00',
	'list'=>1
	];
$result = $broadcast->create($params);
```
 4. Edit Broadcast
**Note:** If the current broadcast is of type SPLIT, then you need to add all messages. If you add only one message, then the type will be SINGLE. The message sent must always be equal to the current Broadcast Message count.
```
$broadcast = new Broadcasts($config);
$param[
	'title'=>'Title',
	'sender'=>'Email Sender',
	'messages[0][subject]'=>'Email Subject',
	'messages[0]['content]'=>'Email content, ', //disallow css and js, read official docs for detail
	];
$result = $broadcast->update($broadcast_guid,$params);
```
 5. Delete Broadcast
```
$broadcast = new Broadcasts($config);
$result = $broadcast->update($broadcast_guid);
```
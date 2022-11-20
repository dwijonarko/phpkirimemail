<?php

namespace Dwijonarko\PHPKirimemail;
/**
 * The Subscriber Field methods let you manage subscriber fields in the system. You use the methods to view, create, update, or delete subscriber fields.
 * @package Dwijonarko\PHPKirimemail
 */
class SubscriberFields extends KontakApi
{

    /** 
     * @param array $config['username','api_token']
     */
    public function __construct($config)
    {
        if (is_array($config)) {
            $this->setConfig($config);
        } else {
            throw new \Exception("Config must be array [username,api_token]");
        }
        $this->setHeader();
    }

    /**
     * The method lets you get all subscriber fields and their details
     * add Offset to header if you want to get more than 100 subscriber fields
     * ex : $this->header['Offset'] = 2;
     * @return string JSON
     *
     */
    public function getAll(){
        $url = "/subscriber_field";
        try {
            $response = $this->curl($url, "GET", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you get a subscriber field by the ID
     * @param int $id
     * @return string JSON
     */
    public function getById($id){
        $url = "/subscriber_field/" . $id;
        try {
            $response = $this->curl($url, "GET", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you create a new subscriber field. 
     * To create a field, you must pass the type of the subscriber field and its name in array body
     * ex $data['type'=>'textarea','name'=>'Address'].
     * @param array $data
     * @return string JSON
     */
    public function create($params){
        $url = "/subscriber_field";
        $this->body = $params;
        try {
            $response = $this->curl($url, "POST", $this->header, $this->body);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you update a subscriber field by the ID
     * @param int $id
     * @param array $data['type'=>'textarea','name'=>'Address']
     * @return string JSON
     */
    public function update($id, $params){
        $url = "/subscriber_field/" . $id;
        $this->body = $params;
        try {
            $response = $this->curl($url, "PUT", $this->header, $this->body);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you delete a subscriber field by the ID
     * @param int $id
     * @return string JSON
     *
     */
    public function delete($id){
        $url = "/subscriber_field/" . $id;
        try {
            $response = $this->curl($url, "DELETE", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

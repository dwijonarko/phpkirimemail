<?php

namespace Dwijonarko\PHPKirimemail;
/**
 * The Subscriber methods let you manage subscribers. You can view all subscribers, get a subscriber, create a subscriber, update a subscriber, and delete a subscriber. 
 * You can use the subscriber ID or email to view, update, or delete them.
 * @package Dwijonarko\PHPKirimemail
 */
class Subscribers extends KontakApi
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
     * The method gets a list of all subscriber and their details.
     * @param int $offset optional
     * @param int $list_id optional
     * @return string JSON
     */
    public function getAll($offset = 0, $list_id = 0)
    {
        $url = "/subscriber";
        $offset > 0 ? $this->header['Offset'] = $offset : "";
        $list_id > 0 ? $this->header['List-Id'] = $list_id : "";
        try {
            $response = $this->curl($url, "GET", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you get a subscriber by the ID
     * @param int $id
     * @return string JSON
     */
    public function getById($id)
    {
        $url = "/subscriber/" . $id;
        try {
            $response = $this->curl($url, "GET", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you get a subscriber by the subscriber email
     */
    public function getByEmail($email)
    {
        $url = "/subscriber/email/" . $email;
        try {
            $response = $this->curl($url, "GET", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you create a subscriber in a list. You must provide the list Id to add the subscriber to the list
     * @param array $data['lists','email','full_name','status'] etc, detail at https://documenter.getpostman.com/view/23706886/2s83zduQge#3d65b781-88e9-4f68-80e7-d37952eb61bb
     * @return string JSON
     */
    public function create($params)
    {
        $url = "/subscriber";
        $this->body = $params;
        try {
            $response = $this->curl($url, "POST", $this->header, $this->body);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you update the email ID and tags of the subscriber using the ID
     * @param int $id
     * @param array $params['email','tags']
     * @return string JSON
     */
    public function update($id, $params)
    {
        $url = "/subscriber/" . $id;
        $this->body = $params;
        try {
            $response = $this->curl($url, "PUT", $this->header, $this->body);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you update the email ID and tags of the subscriber using the subscriber email
     * @param string $email
     * @param array $params['email','tags']
     * @return string JSON
     */
    public function updateByEmail($email, $params)
    {
        $url = "/subscriber/email/" . $email;
        $this->body = $params;
        try {
            $response = $this->curl($url, "PUT", $this->header, $this->body);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you delete the subscriber using the subscriber ID and the list ID.
     * @param int $id
     * @return string JSON
     */
    public function delete($id, $list_id)
    {
        $url = "/subscriber/" . $id;
        try {
            $this->header['List-Id'] = $list_id;
            $response = $this->curl($url, "DELETE", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you delete the subscriber using the subscriber email and the list ID.
     * @param int $id
     * @return string JSON
     */
    public function deleteByEmail($email, $list_id)
    {
        $url = "/subscriber/email/" . $email;
        try {
            $this->header['List-Id'] = $list_id;
            $response = $this->curl($url, "DELETE", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

<?php

namespace Dwijonarko\PHPKirimemail;
/**
 * You can use the List methods to manage lists.
 * @package Dwijonarko\PHPKirimemail
 */
class Lists extends KontakApi
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
     * Get all lists
     * @return string JSON
     */
    public function getAll() 
    {
        $url = "/list";
        try {
            $response = $this->curl($url, "GET", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get list by id
     * @param int $id
     * @return string JSON
     */
    public function getById($id)
    {
        $url = "/list/" . $id;
        try {
            $response = $this->curl($url, "GET", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Create new list
     * @param string $name
     * @return string JSON
     */
    public function create($name)
    {
        $url = "/list";
        $this->body = [
            'name' => $name
        ];
        try {
            $response = $this->curl($url, "POST", $this->header, $this->body);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Update list by id
     * @param int $id
     * @param string $name
     * @return string JSON
     */
    public function update($id, $name)
    {
        $url = "/list/" . $id;
        $this->body = [
            'name' => $name
        ];
        try {
            $response = $this->curl($url, "PUT", $this->header, $this->body);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Delete list by id
     * @param int $id
     * @return string JSON
     */
    public function delete($id)
    {
        $url = "/list/" . $id;
        try {
            $response = $this->curl($url, "DELETE", $this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

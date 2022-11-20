<?php
namespace Dwijonarko\PHPKirimemail;
/**
 * The Broadcast methods let you manage broadcast messages. 
 * You can use these methods to view, create, update, and delete broadcasts.
 * @package Dwijonarko\PHPKirimemail
 */
class Broadcasts extends KontakApi{
    /** 
     * @param array $config['username','api_token']
     */
    public function __construct($config){
        if(is_array($config)){
            $this->setConfig($config);
        }else{
            throw new \Exception("Config must be array [username,api_token]");
        }
        $this->setHeader();
    }

    /**
     * Get all broadcasts
     * @return string JSON
     */
    public function getAll(){
        $url = "/broadcast";
        try{
            $response = $this->curl($url,"GET",$this->header);
            return $response;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    /**
     * Get broadcast by broadcast guid
     * @param string $guid
     * @return string JSON
     */
    public function getByGuid($guid){
        $url = "/broadcast/" . $guid;
        try{
            $response = $this->curl($url,"GET",$this->header);
            return $response;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    /**
     * Create new broadcast
     * @param array $param['title','sender','messages[0][subject]','messages[0]['content]','send_at','list'
     * @return string JSON
     */
    public function create($param){
        $url = "/broadcast";
        try{
            $response = $this->curl($url,"POST",$this->header,$param);
            return $response;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    /**
     * update  broadcast
     * @param array $param['title','sender','messages[0][subject]','messages[0]['content]']
     * @return string JSON
     */
    public function update($guid,$param){
        $url = "/broadcast/" . $guid;
        try{
            $response = $this->curl($url,"POST",$this->header,$param);
            return $response;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    /**
     * Delete broadcast by broadcast guid
     * @param string $guid
     * @return string JSON
     */
    public function delete($guid){
        $url = "/broadcast/" . $guid;
        try{
            $response = $this->curl($url,"DELETE",$this->header);
            return $response;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }
}
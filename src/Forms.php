<?php
namespace Dwijonarko\PHPKirimemail;
/**
 * The Form methods let you view all forms in the system. 
 * You can view all forms, or get specific forms by ID or URL.
 */
class Forms extends KontakApi{
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
     * The method lets you get all forms.
     * @return string JSON
     */
    public function getAll(){
        $url = "/form";
        try {
            $response = $this->curl($url,"GET",$this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you get a landing page by the ID.
     * @param int $id
     * @return string JSON
     */
    public function getById($id){
        $url = "/form/".$id;
        try {
            $response = $this->curl($url,"GET",$this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * The method lets you get a landing page by the URL.
     * @param string $url
     * @return string JSON
     */
    public function getByUrl($url){
        $url = "/form/url/".$url;
        try {
            $response = $this->curl($url,"GET",$this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
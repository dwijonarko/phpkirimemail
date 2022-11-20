<?php
namespace Dwijonarko\PHPKirimemail;
/**
 * The Landing Page methods let you view all landing pages in the system. 
 * You can view all landing pages, or get specific landing pages by ID or URL.
 */
class LandingPages extends KontakApi{
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
     * The method lets you get all landing pages.
     * @return string JSON
     */
    public function getAll(){
        $url = "/landingpage";
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
        $url = "/landingpage/".$id;
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
        $url = "/landingpage/url/".$url;
        try {
            $response = $this->curl($url,"GET",$this->header);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
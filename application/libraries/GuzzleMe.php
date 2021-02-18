<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
class GuzzleMe {
    protected $client;
    protected $resquest;
    protected $response;
    protected $result;
    public function __construct(){
        // parent::__construct();
        $this->client = new Client();
        
    }

    public function request_auth($params){
        try {
            $this->response = $this->client->request('POST',base_url().'/api/auths',$params); 
            $this->result = $this->response->getBody()->getContents();
            return $this->result;
        } catch (ClientException $e) {
            $response = $e->getResponse();
			$this->result = $response->getBody()->getContents();
			return $this->result;
        }
    }

    public function request_get($url,$params){
        try {
            $this->response = $this->client->request('GET',$url,$params); 
            $this->result = $this->response->getBody()->getContents();
            return $this->result;
        } catch (ClientException $e) {
            $response = $e->getResponse();
			$this->result = $response->getBody()->getContents();
			return $this->result;
        }
    }

    public function request_post($url,$params){
        try {
            $this->response = $this->client->request('POST',$url,$params); 
            $this->result = $this->response->getBody()->getContents();
            return $this->result;
        } catch (ClientException $e) {
            $response = $e->getResponse();
			$this->result = $response->getBody()->getContents();
			return $this->result;
        }
    }

    public function request_put($url,$params){
        try {
            $this->response = $this->client->request('PUT',$url,$params); 
            $this->result = $this->response->getBody()->getContents();
            return $this->result;
        } catch (ClientException $e) {
            $response = $e->getResponse();
			$this->result = $response->getBody()->getContents();
			return $this->result;
        }
    }

    public function request_delete($url,$params){
        try {
            $this->response = $this->client->request('DELETE',$url,$params); 
            $this->result = $this->response->getBody()->getContents();
            return $this->result;
        } catch (ClientException $e) {
            $response = $e->getResponse();
			$this->result = $response->getBody()->getContents();
			return $this->result;
        }
    }

    


}
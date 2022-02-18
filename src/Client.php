<?php
    namespace Tchevalleraud\ExtremeNetworks\XIQSE;

    class Client {

        private $client;
        private $config;
        private $cookie;
        private $token;

        public function __construct(Config $config){
            $this->config = $config;

            $this->client = new \GuzzleHttp\Client();
            $this->cookie = new \GuzzleHttp\Cookie\CookieJar();

            $this->initToken();
        }

        public function getNBIAdministrationServerInfo(){
            $data = [];
            $rep = $this->getServiceNbiQuery("query { administration { serverInfo { upTime version } } }");
            return $rep;
        }

        public function getServiceNbiQuery($query = ""){
            try {
                $res = $this->getRequest("/connect/rest/services/nbi/query", "POST", [
                    "body"      => $query,
                    "headers"   => [
                        "Content-Type"  => "application/json"
                    ]
                ]);
                $response = json_decode($res->getBody()->getContents());
                return $response;
            } catch (\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }

        public function getToken(){
            return $this->token;
        }

        private function initToken(){
            try {
                $res = $this->getRequest("/oauth/token/access-token?grant_type=client_credentials", "POSt", [
                    "auth"  => [$this->config->getClientId(), $this->config->getClientSecret()]
                ]);
                $response = json_decode($res->getBody()->getContents());
                $this->token = $response->access_token;
            } catch (\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }

        private function getRequest($uri, $method = "GET", $params = []){
            $params = array_merge([
                "body"      => null,
                "cookies"   => $this->cookie,
                "verify"    => false
            ], $params);

            try {
                return $this->client->request($method, $this->config->getUrl().$uri, $params);
            } catch (\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }

    }
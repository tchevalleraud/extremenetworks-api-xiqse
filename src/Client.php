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

        public function NBIAccessControlAddMACToEndSystemGroup($group, $value){
            return $this->getServiceNbiMutation('mutation { accessControl { addMACToEndSystemGroup(input: { group: "'. $group .'", value: "'. $value .'" }) { status } } }');
        }

        public function NBIAccessControlCreateGroup($name){
            return $this->getServiceNbiMutation('mutation { accessControl { createGroup(input: { name: "'. $name .'" }) { status } } }');
        }

        public function NBIAccessControlDeleteGroup($name){
            return $this->getServiceNbiMutation('mutation { accessControl { deleteGroup(input: { name: "'. $name .'" }) { status } } }');
        }

        public function NBIAccessControlRemoveMACToEndSystemGroup($group, $value){
            return $this->getServiceNbiMutation('mutation { accessControl { removeMACFromEndSystemGroup(input: { group: "'. $group .'", value: "'. $value .'" }) { status } } }');
        }

        public function getNBIAdministrationServerInfo(){
            return $this->getServiceNbiQuery("query { administration { serverInfo { upTime version } } }");
        }

        public function getServiceNbiMutation($query = ""){
            $res = $this->getRequest("/connect/rest/services/nbi/mutation", "POST", [
                "body"      => $query,
                "headers"   => [
                    "Content-Type"  => "application/json"
                ]
            ]);

            return json_decode($res->getBody()->getContents());
        }

        public function getServiceNbiQuery($query = ""){
            $res = $this->getRequest("/connect/rest/services/nbi/query", "POST", [
                "body"      => $query,
                "headers"   => [
                    "Content-Type"  => "application/json"
                ]
            ]);

            return json_decode($res->getBody()->getContents());
        }

        public function getToken(){
            return $this->token;
        }

        private function initToken(){
            $res = $this->getRequest("/oauth/token/access-token?grant_type=client_credentials", "POSt", [
                "auth"  => [$this->config->getClientId(), $this->config->getClientSecret()]
            ]);
            $response = json_decode($res->getBody()->getContents());
            $this->token = $response->access_token;
        }

        private function getRequest($uri, $method = "GET", $params = []){
            $params = array_merge([
                "body"      => null,
                "cookies"   => $this->cookie,
                "verify"    => false
            ], $params);

            try {
                return $this->client->request($method, $this->config->getUrl().$uri, $params);
            } catch (\GuzzleException $exception){
                throw new \GuzzleException($exception->getMessage());
            }
        }

    }
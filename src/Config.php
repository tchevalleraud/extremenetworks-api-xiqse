<?php
    namespace Tchevalleraud\ExtremeNetworks\XIQSE;

    class Config {

        private $clientId;
        private $clientSecret;
        private $port;
        private $protocol;
        private $server;

        public function __construct($server, $clientId, $clientSecret, $protocol = "https", $port = "8443"){
            $this->setServer($server);
            $this->setClientId($clientId);
            $this->setClientSecret($clientSecret);
            $this->setProtocol($protocol);
            $this->setPort($port);
        }

        public function getClientId() {
            return $this->clientId;
        }

        public function setClientId($clientId) {
            $this->clientId = $clientId;
            return $this;
        }

        public function getClientSecret() {
            return $this->clientSecret;
        }

        public function setClientSecret($clientSecret) {
            $this->clientSecret = $clientSecret;
            return $this;
        }

        public function getPort() {
            return $this->port;
        }

        public function setPort($port) {
            $this->port = $port;
            return $this;
        }

        public function getProtocol() {
            return $this->protocol;
        }

        public function setProtocol($protocol) {
            $this->protocol = $protocol;
            return $this;
        }

        public function getServer() {
            return $this->server;
        }

        public function setServer($server) {
            $this->server = $server;
            return $this;
        }

    }
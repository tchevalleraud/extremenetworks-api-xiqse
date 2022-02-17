<?php
    class ClientTest extends \PHPUnit\Framework\TestCase {

        private function getConfig(){
            return new \Tchevalleraud\ExtremeNetworks\XIQSE\Config("192.168.1.1", "bhkemlwVvj", "53e55769-50c8-483d-9665-40e497dc03fc");
        }

        public function testClient_instanceOf(){
            $config = $this->getConfig();
            $client = new \Tchevalleraud\ExtremeNetworks\XIQSE\Client($config);
            $this->assertInstanceOf(\Tchevalleraud\ExtremeNetworks\XIQSE\Client::class, $client);
        }

    }
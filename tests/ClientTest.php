<?php
    class ClientTest extends \PHPUnit\Framework\TestCase {

        private function getConfig(){
            return new \Tchevalleraud\ExtremeNetworks\XIQSE\Config("192.168.1.131", "jy9g3TXfyE", "2885ca56-a154-4643-ad60-d7d0ca428c77");
        }

        private function getFailedConfig1(){
            return new \Tchevalleraud\ExtremeNetworks\XIQSE\Config("192.168.1.1", "", "");
        }

        private function getFailedConfig2(){
            return new \Tchevalleraud\ExtremeNetworks\XIQSE\Config("192.168.1.131", "", "");
        }

        public function testClient_instanceOf(){
            $client = new \Tchevalleraud\ExtremeNetworks\XIQSE\Client($this->getConfig());
            $this->assertInstanceOf(\Tchevalleraud\ExtremeNetworks\XIQSE\Client::class, $client);
        }

        public function testClient_initToken(){
            $client = new \Tchevalleraud\ExtremeNetworks\XIQSE\Client($this->getConfig());
            $this->assertIsNotBool($client->getToken());
            $this->assertEquals("21.11.11.37", $client->getNBIAdministrationServerInfo()->administration->serverInfo->version);
        }

        public function testClient_ServerInfo_ConnectionRefused(){
            $this->expectException("Exception");
            $this->expectExceptionMessageMatches("/(Connection refused for URI|Failed to connect)/");

            $client = new \Tchevalleraud\ExtremeNetworks\XIQSE\Client($this->getFailedConfig1());
            $client->getNBIAdministrationServerInfo();
        }

        public function testClient_ServerInfo_Name(){
            $this->expectException("Exception");
            $this->expectExceptionMessageMatches("/Client error: (.*) resulted in a `401 Unauthorized` response/");

            $client = new \Tchevalleraud\ExtremeNetworks\XIQSE\Client($this->getFailedConfig2());
            $client->getNBIAdministrationServerInfo();
        }

    }
<?php
    class ConfigTest extends \PHPUnit\Framework\TestCase {

        public function testConfig_instanceOf(){
            $config = new \Tchevalleraud\ExtremeNetworks\XIQSE\Config("192.168.1.1", "bhkemlwVvj", "53e55769-50c8-483d-9665-40e497dc03fc");
            $this->assertInstanceOf(\Tchevalleraud\ExtremeNetworks\XIQSE\Config::class, $config);
        }

        public function testConfig_construct(){
            $config = new \Tchevalleraud\ExtremeNetworks\XIQSE\Config("192.168.1.1", "bhkemlwVvj", "53e55769-50c8-483d-9665-40e497dc03fc");
            $this->assertEquals(new \Tchevalleraud\ExtremeNetworks\XIQSE\Config("192.168.1.1", "bhkemlwVvj", "53e55769-50c8-483d-9665-40e497dc03fc"), $config);

            $this->assertEquals("192.168.1.1", $config->getServer());
            $this->assertEquals("bhkemlwVvj", $config->getClientId());
            $this->assertEquals("53e55769-50c8-483d-9665-40e497dc03fc", $config->getClientSecret());
            $this->assertEquals("https", $config->getProtocol());
            $this->assertEquals("8443", $config->getPort());
        }

    }
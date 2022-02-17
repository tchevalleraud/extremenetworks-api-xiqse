<?php
    class Package1Test extends \PHPUnit\Framework\TestCase {

        public function testPackage1_instanceOf(){
            $package = new \Tchevalleraud\TestPackage\Package1();
            $this->assertInstanceOf(\Tchevalleraud\TestPackage\Package1::class, $package);
        }

        public function testPackage1_construct(){
            $package = new \Tchevalleraud\TestPackage\Package1();
            $this->assertEquals(new \Tchevalleraud\TestPackage\Package1(), $package);
        }

        public function testPackage1(){
            $package = new \Tchevalleraud\TestPackage\Package1(['data' => 1]);
            $this->assertEquals(['data' => 1], $package->getData());

            $package->setData(['data_new' => 2]);
            $this->assertEquals(['data_new' => 2], $package->getData());
        }

    }
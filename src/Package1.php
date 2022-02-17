<?php
    namespace Tchevalleraud\TestPackage;

    class Package1 {

        private $data;

        public function __construct($data = []){
            $this->data = $data;
        }

        public function getData(){
            return $this->data;
        }

        public function setData($data = []){
            $this->data = $data;
            return $this;
        }

    }
<?php

namespace BSP\AccountingBundle\Model;

interface ExtendedDataInterface
{
    public function isEncryptionRequired($name);
    public function remove($name);
    public function set($name, $value, $encrypt = true);
    public function get($name);
    public function all();
    public function equals(ExtendedDataInterface $data);
}

<?php

namespace BSP\AccountingBundle\Type;

use BSP\AccountingBundle\Model\ExtendedDataInterface;

class ExtendedData implements ExtendedDataInterface
{
    private $data;
    private $listeners;

    public function __construct()
    {
        $this->data = array();
    }

    public function remove($name)
    {
        unset($this->data[$name]);
    }

    public function isEncryptionRequired($name)
    {
        if (!isset($this->data[$name])) {
            throw new \InvalidArgumentException(sprintf('There is no data with key "%s".', $name));
        }

        return $this->data[$name][1];
    }
    
    public function mayBePersisted($name)
    {
        if (!isset($this->data[$name])) {
            throw new \InvalidArgumentException(sprintf('There is no data with key "%s".', $name));
        }

        return $this->data[$name][2];
    }

    public function set($name, $value, $encrypt = true, $persist = true)
    {
        if ($encrypt && !$persist) {
            throw new \InvalidArgumentException(sprintf('Non persisted field cannot be encrypted "%s".', $name));
        }
        
        $this->data[$name] = array($value, $encrypt, $persist);
    }

    public function get($name)
    {
        if (!isset($this->data[$name])) {
            throw new \InvalidArgumentException(sprintf('There is no data with key "%s".', $name));
        }

        return $this->data[$name][0];
    }

    public function has($name)
    {
        return isset($this->data[$name]);
    }

    public function all()
    {
        return $this->data;
    }

    public function equals(ExtendedDataInterface $data)
    {
        $data = $data->all();
        ksort($data);

        $cData = $this->data;
        ksort($cData);

        return $data === $cData;
    }
}
<?php

namespace BSP\AccountingBundle\Type\MongoDB;

use BSP\AccountingBundle\Cryptography\EncryptionServiceInterface;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\ODM\MongoDB\Mapping\Types\Type;

class ExtendedDataType extends Type
{
    const NAME = 'EncryptedData';

    private static $encryptionService;

    public static function setEncryptionService(EncryptionServiceInterface $service)
    {
        self::$encryptionService = $service;
    }

    public static function getEncryptionService()
    {
        return self::$encryptionService;
    }

    public function convertToDatabaseValue($extendedData)
    {
        if (null === $extendedData) {
            return null;
        }

        $reflection = new \ReflectionProperty($extendedData, 'data');
        $reflection->setAccessible(true);
        $data = $reflection->getValue($extendedData);
        $reflection->setAccessible(false);

        foreach ($data as $name => $value) {
            if (false === $value[2]) {
                unset($data[$name]);
                continue;
            }
            if (true === $value[1]) {
                $data[$name][0] = self::$encryptionService->encrypt(serialize($value[0]));
            }
        }

        return $data;
    }

    public function convertToPHPValue($value)
    {
        $data = $value;

        if (null === $data) {
            return null;
        } elseif (is_array($data)) {
            foreach ($data as $name => $value) {
                if (true === $value[1]) {
                    $data[$name][0] = unserialize(self::$encryptionService->decrypt($value[0]));
                }
            }

            $extendedData = new ExtendedData;
            $reflection = new \ReflectionProperty($extendedData, 'data');
            $reflection->setAccessible(true);
            $reflection->setValue($extendedData, $data);
            $reflection->setAccessible(false);

            return $extendedData;
        } else {
            throw ConversionException::conversionFailed($value, $this->getName());
        }
    }

    public function getName()
    {
        return self::NAME;
    }
}

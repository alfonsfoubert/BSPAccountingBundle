<?php

namespace BSP\AccountingBundle\Cryptography;

/**
 * Interface for encryption services
 */
interface EncryptionServiceInterface
{
    /**
     * This method decrypts the passed value.
     *
     * @param string $encryptedValue
     */
    public function decrypt($encryptedValue);

    /**
     * This method encrypts the passed value.
     *
     * Binary data may be base64-encoded.
     *
     * @param string $rawValue
     */
    public function encrypt($rawValue);
}

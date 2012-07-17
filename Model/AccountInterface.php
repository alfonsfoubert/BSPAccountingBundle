<?php

namespace BSP\AccountingBundle\Model;

interface AccountInterface
{
    const ACCOUNT_STATUS_PENDING  = 100;
    const ACCOUNT_STATUS_ACTIVE   = 200;
    const ACCOUNT_STATUS_CANCELED = 300;
    const ACCOUNT_STATUS_BLOCKED  = 400;

    public function getId();
    public function getName();
    public function getStatus();
    public function setId($id);
    public function setName($name);
    public function setStatus($status);
    public function setCreatedAt();
    public function getCreatedAt();
}

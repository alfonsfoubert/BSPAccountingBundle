<?php

namespace BSP\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BSP\AccountingBundle\Model\Account as BaseAccount;

/**
 * @ORM\Table(name="accounts")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Account extends BaseAccount
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    protected $status;

    /**
     * @ORM\Column(name="units", type="string", length=255, nullable=false)
     */
    protected $units;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    protected $createdAt;

    /** @ORM\PrePersist */
    public function prePersistAccount()
    {
        parent::setCreatedAt();
    }

}

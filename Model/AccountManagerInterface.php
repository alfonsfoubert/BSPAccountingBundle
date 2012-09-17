<?php

namespace BSP\AccountingBundle\Model;

interface AccountManagerInterface
{
    public function getClass();
    public function createAccount( $generator = 'default', array $options = null );
    public function findAccountBy(array $criteria);
    public function findAccountById( $id );
    public function findAccountByName( $name );
    public function findAccounts();
    public function findSystemAccount( $account );
    public function updateAccount( AccountInterface $account, $andFlush = true );
    public function balance( $account, $repository );
}

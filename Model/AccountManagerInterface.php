<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\AccountingInterface;

interface AccountManagerInterface
{
	function getClass();
	function createAccount( $generator = 'default', array $options = null );
	function findAccountBy(array $criteria);
	function findAccountById( $id );
	function findAccounts();
	function updateAccount( AccountInterface $account, $andFlush = true );
	function balance( $account, $repository );
}
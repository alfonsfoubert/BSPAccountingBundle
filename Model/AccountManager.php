<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\AccountManagerInterface;
use BSP\AccountingBundle\Provider\AccountIdGeneratorProvider;

abstract class AccountManager implements AccountManagerInterface
{
	protected $accountIdProvider;
	
	public function __construct( AccountIdGeneratorProvider $accountIdProvider )
	{
		$this->accountIdProvider = $accountIdProvider;
	}
	
	public function createAccount( $type = 'default', array $options = null )
	{
		$account = new $this->getClass();
		$account->setId( $this->accountIdProvider->generateId( $type, $options ) );
		return $account;
	}
	
	public function findAccountById( $id )
	{
		return $this->findAccountBy( array( 'id' => $id ) );
	}
}
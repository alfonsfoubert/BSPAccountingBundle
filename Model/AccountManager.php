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
	
	public function createAccount( $generator = 'default', array $options = null )
	{
		$class = $this->getClass();
		$account = new $class();
		$account->setId( $this->accountIdProvider->generateId( $generator, $options ) );
		return $account;
	}
	
	public function findAccountById( $id )
	{
		return $this->findAccountBy( array( 'id' => $id ) );
	}
	
	
	public function getIdGeneratorHandlers()
	{
		return $this->accountIdProvider->listAccountHandlers();
	}
}
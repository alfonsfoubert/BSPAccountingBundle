<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\AccountManagerInterface;
use BSP\AccountingBundle\Provider\AccountIdGeneratorProvider;
use Symfony\Component\Yaml\Yaml;

abstract class AccountManager implements AccountManagerInterface
{
	protected $accountIdProvider;
	protected $systemAccountsFile;
	
	public function __construct( AccountIdGeneratorProvider $accountIdProvider, $systemAccountsFile )
	{
		$this->accountIdProvider  = $accountIdProvider;
		$this->systemAccountsFile = $systemAccountsFile;
	}
	
	public function createAccount( $generator = 'default', array $options = null )
	{
		$class = $this->getClass();
		$account = new $class();
		$account->setId( $this->accountIdProvider->generateId( $generator, $options ) );
		$account->setStatus( \BSP\AccountingBundle\Model\AccountInterface::ACCOUNT_STATUS_ACTIVE );
		return $account;
	}
	
	public function findSystemAccount( $account )
	{
	    // Parse the account path
	    $path = preg_split( '/[. ]+/', $account );
	    
	    // Read the Yaml file
	    $loader = Yaml::parse($this->systemAccountsFile);
	    	    
	    $id = $loader['accounts'];
	    foreach($path as $key)
	    {
	        if ( ! isset( $id[$key] ) )
	        {
	            throw new \Exception( 'System Account ' . $account . ' does not exists in config file' );
	        }
	        $id = $id[$key];
	    }
	    
	    return $this->findAccountById( $id );
	}
	
	public function findAccountById( $id )
	{
		return $this->findAccountBy( array( 'id' => $id ) );
	}
	
	public function findAccountByName( $name )
	{
	    return $this->findAccountBy( array( 'name' => $name ) );
	}
	
	public function getIdGeneratorHandlers()
	{
		return $this->accountIdProvider->listAccountHandlers();
	}
}
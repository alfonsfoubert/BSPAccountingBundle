<?php

namespace BSP\AccountingBundle\Document;

use BSP\AccountingBundle\Model\AccountManager as AbstractAccountManager;
use BSP\AccountingBundle\Model\AccountInterface;

class AccountManager extends AbstractAccountManager
{
	protected $dm;
	protected $repository;
	protected $class;
	
	public function __construct( $dm, $accountClass, $accountIdProvider )
	{
		parent::__construct( $accountIdProvider );
		
		$this->dm = $dm;
		$this->repository = $dm->getRepository($accountClass);
		$metadata = $dm->getClassMetadata($accountClass);
		$this->class = $metadata->name;
	}
	
	public function findAccountBy( array $criteria  )
	{
		return $this->repository->findOneBy($criteria);
	}
	
	public function getClass()
	{
		return $this->class;
	}
	
	function findAccounts()
	{
		return $this->repository->findAll();
	}
	
	public function updateAccount(AccountInterface $account, $andFlush = true)
	{
		$this->dm->persist($account);
		if ($andFlush) {
			$this->dm->flush();
		}
	}
	
	public function getBalance( $account )
	{
		$this->dm->getConnection()->connect();
		var_dump($this->dm->getConfiguration());
		return 0;
		$db = $this->dm->getConnection()->__get($parameters['mongo_database']);
		$result = $db->execute( 'eval(\'balance("'.$account->getId().'")\')' );
		if ($result['ok'] == 1)
		{
			return $result['retval'];
		}
		else
		{
			return $result['errmsg'];
		}
		return 0;
	}
}
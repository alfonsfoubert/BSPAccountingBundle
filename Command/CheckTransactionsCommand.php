<?php

namespace BSP\AccountingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckTransactionsCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
		->setName('bsp:account:check:transactions')
		->setDescription('Checks for the incorrect transactions')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{	    
		$accountingManipulator = $this->getContainer()->get('bsp_accounting.manipulator');
		$transactions          = $accountingManipulator->checkTransactions();
		
		if ($transactions->count() > 0)
		{
		    $output->writeln('You have incorrect transactions:');
    		foreach ($transactions as $transaction)
    		{
    			$output->writeln( '    <info>' . $transaction->getId() . '</info>');
    		}
		}
		else
		{
		    $output->writeln('<comment>All correct!</comment>');
		}
	}
}

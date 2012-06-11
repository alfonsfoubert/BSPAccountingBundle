<?php

namespace BSP\AccountingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use BSP\AccountingBundle\Model\AccountingEntryInterface;

class BalanceCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
		->setName('bsp:account:balance')
		->setDescription('Get the Balance')
		->addArgument('account', InputArgument::REQUIRED, 'Which account do you want to query?')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$account = $input->getArgument('account');
        
		try
		{
			$manipulator = $this->getContainer()->get('bsp_accounting.manipulator');
			$balance = $manipulator->balance($account);
			$output->writeln('<info>'.$balance.'</info>');
		}
		catch ( \Exception $e )
		{
			$output->writeln( '<error>'.$e->getMessage().'</error>' );
		}
	}
}

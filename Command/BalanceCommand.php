<?php

namespace BSP\AccountingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
		$account_id = $input->getArgument('account');
		$account_manager = $this->getContainer()->get('bsp_accounting.account_manager');
		$account = $account_manager->findAccountById( $account_id );
		
		if ( ! $account)
		{
			$output->writeln( '<error>Account '.$account_id.' not found</error>' );
		}
		
		$balance = $account_manager->getBalance($account);
		$output->writeln('<info>'.$balance.'</info>');
	}
}

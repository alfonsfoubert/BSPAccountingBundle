<?php

namespace BSP\AccountingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAccountCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('bsp:accounting:create')
            ->setDescription('Create an account.')
            ->setDefinition(array(
                new InputArgument('name', InputArgument::REQUIRED, 'The name'),
                new InputArgument('units', InputArgument::REQUIRED, 'The units'),
                new InputArgument('generator', InputArgument::REQUIRED, 'The id generator of the account'),
                new InputArgument('options', InputArgument::OPTIONAL, 'Options for the generator'),
            ))
            ->setHelp(<<<EOT
The <info>bsp:account:create</info> command creates an account:

  <info>php app/console bsp:account:create "Mike's account" EUR</info>

This interactive shell will ask you for a id generator and the options.

You can alternatively specify the generator as the third argument:

  <info>php app/console bsp:currency:create "Mike's account" EUR default "1,2,3,4"</info>

EOT
            );
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name      = $input->getArgument('name');
        $units     = $input->getArgument('units');
        $generator = $input->getArgument('generator');
        $options   = $input->getArgument('options');

        $manipulator = $this->getContainer()->get('bsp_accounting.manipulator');
        $account = $manipulator->createAccount( $name, $units, $generator, $options );
        $output->writeln(sprintf('Account <comment>%s</comment> created succesfully', $account->getId() ));
    }

    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('name')) {
            $name = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a name: ',
                function($name) {
                    if (empty($name)) {
                        throw new \Exception('Name can not be empty');
                    }

                    return $name;
                }
            );
            $input->setArgument('name', $name);
        }

        if (!$input->getArgument('units')) {
            $units = $this->getHelper('dialog')->askAndValidate(
                    $output,
                    'Please choose the units: ',
                    function($units) {
                        if (empty($units)) {
                            throw new \Exception('Units can not be empty');
                        }

                        return $units;
                    }
                    );
                    $input->setArgument('units', $units);
        }

        if (!$input->getArgument('generator')) {
            $accountManager = $this->getContainer()->get('bsp_accounting.account_manager');
            $generator = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a generator [' . implode( ",", $accountManager->getIdGeneratorHandlers() ) . ']: ',
                function($generator) {
                    if (empty($generator)) {
                        $generator = 'default';
                    }

                    return $generator;
                }
            );
            $input->setArgument('generator', $generator);
        }

        if (!$input->getArgument('options')) {
            $options = $this->getHelper('dialog')->askAndValidate(
                    $output,
                    'Please specify the options coma separated: ',
                    function($options) {
                        if (empty($options)) {
                            $options = '';
                        }

                        return explode( ',', $options );
                    }
                    );
                    $input->setArgument('options', $options);
        }
    }
}

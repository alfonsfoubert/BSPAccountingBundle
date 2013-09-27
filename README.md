# BSPAccountingBundle

This bundle provides a double-entry accounting system for Symfony2. 

## Installation

Installation is a 3 step process:

1. Download BSPAccountingBundle using composer
2. Enable the Bundle
3. Configure the bundle

### Step 1: Download BSPAccountingBundle using composer

``` js
{
	"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/D3r3ck/BSPAccountingBundle"
        }
    ],
    "require": {
        "d3r3ck/bsp-accounting-bundle": "v1.0.*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update d3r3ck/bsp-accounting-bundle
```

Composer will install the bundle to your project's `vendor/d3r3ck/bsp-accounting-bundle` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new BSP\AccountingBundle\BSPAccountingBundle(),
    );
}
```
### Step 3: Configure the bundle

Add the following lines to your config.yml

``` yaml
# app/config/config.yml

bsp_accounting:
	db_driver: mongodb # Currently only works with mongodb, we are working on orm
	secret: mysecretkey
	system_accounts: path/to/my/system/accounts.yml
```

And you are done!

## Basic Usage

This bundle works basically by a transactions manipulator:

``` php
$manipulator = $this->get('bsp_accounting.manipulator');
```

### Creating an account

In order to create an account you only have to do:

``` php
$manipulator->createAccount( 'My Account', 'EUR' );
```

You can specify a provider for the ID generation. 
The default one is `uniqid()` but there are 2 more:

``` php
$manipulator->createAccount( 'My Account', 'EUR', 'mongodb' );
```

and

``` php
$manipulator->createAccount( 'My Account', 'EUR', 'manual', array( 'id' => 'ABC30045' ) );
```

### Create a transaction

``` php
$manipulator->createTransaction( 'My Transaction' );
```

You can pass extra information you need as second parameter

``` php
$manipulator->createTransaction( 'My Transaction', array( 'book' => 'Foo', ... ) );
```

### Adding an accounting entry

You can add a accounting movement by doing the following

``` php
use BSP\AccountingBundle\Model\AccountingEntryInterface;

$manipulator->addAccountingEntry( 'My Transaction', 'My Account', AccountingEntryInterface::TRANSACTION_TYPE_APPROVE, 1000 );
```

Supported transaction types are:

* TRANSACTION_TYPE_APPROVE
* TRANSACTION_TYPE_APPROVE_AND_DEPOSIT
* TRANSACTION_TYPE_CREDIT
* TRANSACTION_TYPE_DEPOSIT
* TRANSACTION_TYPE_REVERSE_APPROVAL
* TRANSACTION_TYPE_REVERSE_CREDIT
* TRANSACTION_TYPE_REVERSE_DEPOSIT

### Close a transaction

``` php
use BSP\AccountingBundle\Model\ExtendedDataInterface

$manipulator->closeTransaction( 'My Transaction', ExtendedDataInterface::STATE_SUCCESS );
``` 

Supported status are:

* STATE_CANCELED
* STATE_FAILED
* STATE_PENDING
* STATE_SUCCESS

You can also cancel a transaction by this function

``` php
$manipulator->cancelTransaction( 'My Transaction' );
``` 


## Extra

This bundle includes some functionalities that you can use with manipulator or with console command. Those are:

### Check transactions

``` bash
php app/console bsp:accounting:check:transactions
```

This command checks the transactions looking for the unclosed ones

### Balance

``` bash
php app/console bsp:accounting:balance "My Account"
```

This command gives you the account's balance

### Load Accounts

``` bash
php app/console bsp:accounting:load
```

This commands loads your system accounts from your yaml file specified in `config.yml` and saves them into the database

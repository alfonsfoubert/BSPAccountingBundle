<?php

namespace BSP\AccountingBundle\Handler;

interface AccountHandlerInterface
{
	function getType();
	function generateId( array $options = null );
}
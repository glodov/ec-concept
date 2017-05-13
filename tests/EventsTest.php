<?php

include_once(__DIR__ . '/../vendor/autoload.php');

use PHPUnit\Framework\TestCase;

class EventsTest extends TestCase
{
	public function testManager()
	{
		$mgr = new ManagerTest;
		$mgr->run();
	}
}

class ManagerTest extends ecConcept\Events\Manager
{
	protected function onInit()
	{
		
	}
}
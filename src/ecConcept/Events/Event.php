<?php

namespace ecConcept\Events;

class Event
{
	public $name;
	public $object;
	public $target;
	public $args = [];

	public function __construct($name, $object, $target = null, array $args = [])
	{
		$this->name   = $name;
		$this->object = $object;
		$this->target = $target;
		$this->args   = $args;
	}
}
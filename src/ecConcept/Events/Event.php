<?php

namespace ecConcept\Events;

class Event
{
	public $name;
	public $callback;

	public function __construct(
		$name, 
		$callback)
	{
		$this->name     = $name;
		$this->callback = $callback;
	}

	public function call($object = null, array $args = [])
	{
		return call_user_func_array($this->callback, [$object, $args]);
	}
}
<?php

namespace ecConcept\Events;

abstract class Manager implements \eeConcept\Bootstrap\BootstrapInterface
{
	private static $__events = [];
	private static $__allowed;

	abstract protected function onInit();

	protected static function registerAllowed($name)
	{
		if (is_array($name)) {
			foreach ($name as $item) {
				static::registerAllowed($name);
			}
			return true;
		}
		if (!is_array(self::$__allowed)) {
			self::$__allowed = [];
		}
		self::$__allowed[] = $name;
		return true;
	}

	protected static function registerEvent(array $events)
	{
		foreach ($events as $name) {
			static::registerEvent($name);
		}
	}

	public function run()
	{
		$this->onInit();
	}
}
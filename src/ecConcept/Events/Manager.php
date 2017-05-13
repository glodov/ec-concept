<?php

namespace ecConcept\Events;

abstract class Manager implements \ecConcept\Bootstrap\BootstrapInterface
{
	private static $__events = [];
	private static $__allowed;

	abstract protected function onInit();

	public static function registerAllowed($name)
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

	public static function registerEvent(Event $event)
	{
		if (is_array(self::$__allowed) && !in_array($event->name, self::$__allowed)) {
			trigger_error("Event is not allowed");
			return false;
		}
		self::$__events[] = $event;
		return true;
	}

	public static function registerEvents(array $events)
	{
		foreach ($events as $name) {
			static::registerEvent($name);
		}
	}

	public static function getEvents($name = false)
	{
		if (false === $name) {
			return self::$__events;
		}
		$result = [];
		foreach (self::$__events as $event) {
			if ($name === $event->name) {
				$result[] = $event;
			}
		}
		return $result;
	}

	public function run()
	{
		$this->onInit();
	}
}
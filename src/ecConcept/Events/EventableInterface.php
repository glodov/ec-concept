<?php

namespace ecConcept\Events;

interface EventableInterface
{
	public static function addEvent(Event $event);

	public static function triggerEvent($name, $target = null, $args = []);
}

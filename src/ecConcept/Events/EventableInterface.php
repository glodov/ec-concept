<?php

namespace ecConcept\Events;

interface EventableInterface
{
	public function addEvent(Event $event);

	public function triggerEvent($name, $target = null, $args = []);
}

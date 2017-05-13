<?php

include_once(__DIR__ . '/../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use ecConcept\Events\Manager as EventManager;
use ecConcept\Events\Event;

class EventsTest extends TestCase
{
	public function testEvents()
	{
		PaymentController::addEvent(new Event('onSuccess', function ($target) {
			$this->assertTrue(
				$target instanceof PaymentController,
				'PaymentController::onSuccess()'
			);
		}));

		PaymentController::addEvent(new Event('onFailed', [$this, 'paymentOnFailed']));

		$ctrl = new PaymentController;
		$ctrl->successAction();
		$ctrl->failedAction();
	}

	public function paymentOnFailed($target)
	{
		$this->assertTrue(
			$target instanceof PaymentController, 
			'PaymentController::onFailed()'
		);
	}
}

class PaymentController 
	implements ecConcept\Events\EventableInterface
{
	public static function addEvent(Event $event)
	{
		EventManager::registerEvent($event);
	}

	public static function triggerEvent($name, $target = null, $args = [])
	{
		foreach (EventManager::getEvents($name) as $event) {
			$event->call($target, $args);
		}
	}

	public function successAction()
	{
		static::triggerEvent('onSuccess', $this);
	}

	public function failedAction()
	{
		static::triggerEvent('onFailed', $this);
	}
}
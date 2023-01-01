<?php

namespace Boilerplate\Module\Event;

use Bitrix\Main\EventManager;
use Bitrix\Main\Page\Asset;

class EventHandler
{
	public static function OnPageStart()
	{
		$msg = 'Boilerplate event module initialized.';
		Asset::getInstance()->addString('<script>console.log("'. $msg .'")</script>', true);
	}
}

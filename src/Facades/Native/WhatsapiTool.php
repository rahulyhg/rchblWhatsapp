<?php 
namespace Gentrobot\Whatsapi\Facades\Native;

use UnexpectedValueException;
use Gentrobot\Whatsapi\Tools\MGP25;
use Gentrobot\Whatsapi\Events\Listener;
use Gentrobot\Whatsapi\Sessions\Native\Session;

class WhatsapiTool extends Facade 
{
	use ResourceTrait;

    protected static function create()
    {
        if(!$config = static::$config)
        {
            throw new UnexpectedValueException("You must provide config details in order to use Whatsapi Registration Tool");
        }

        $session = new Session;

        $listener = new Listener($session, $config);

        $whatsapi = new MGP25($listener, $config['debug'], $config["data-storage"]);

        if($eventListener = static::$listener)
        {
            $whatsapi->setListener($eventListener);
        }

        return $whatsapi;
    }
}
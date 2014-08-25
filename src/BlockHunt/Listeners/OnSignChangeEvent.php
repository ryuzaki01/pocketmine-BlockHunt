<?php
namespace BlockHunt\Listeners;

use BlockHunt\BlockHunt;
use BlockHunt\Handlers\SignsHandler;
use pocketmine\block\Block;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\block\SignChangeEvent;

class OnSignChangeEvent implements Listener
{
	public $plugin;

    public function __construct(BlockHunt $plugin){
        $this->plugin = $plugin;
    }
	
	public function onSignChangeEvent(SignChangeEvent $event, Player $sender)
	{
	 $lines = $event->getLines();
	 if ($lines[0] != null) {
	   if ((strtolower($lines[0]) === "[" + strtolower($this->plugin->getName()) + "]" ) && $sender->hasPermission("blockhunt.moderator.signcreate")) {
		 SignsHandler::createSign($event, $lines, new Position($event->getBlock()->getX(), $event->getBlock()->getY(), $event->getBlock()->getZ(), $event->getBlock()->getLevel()));
	   }
	 }
	}
}
?>
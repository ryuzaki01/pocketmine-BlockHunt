<?php

namespace BlockHunt\Tasks;
use pocketmine\Player;
use pocketmine\scheduler\PluginTask;
use pocketmine\Server;
class PlayerObserverTask extends PluginTask{
	private $plugin;
	
	public function __construct(Plugin $plugin){
		parent::__construct($plugin);
		$this->plugin = $plugin;
	}

	public function onRun($currentTick){
		
	}
}

?>
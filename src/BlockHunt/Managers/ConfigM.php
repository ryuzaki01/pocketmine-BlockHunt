<?php
namespace BlockHunt\Managers;

use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class ConfigM {
	private $plugin;
	private $filename;
	
	public function __construct(Plugin $plugin, $filename)
	{
		$this->plugin = $plugin;
		$this->filename = $filename;
	}
	
	public static function init(){
		if (!file_exists($this->plugin->dataDir . $this->filename.".yml")) {
			$this->plugin->getLogger()->info(TextFormat::RED ."Can't find ".$this->filename." creating new one !");
			$d = new Config($this->plugin->dataDir . $this->filename . ".yml", Config::YAML, array());
			
			$d->save();
			return $d;
		}
		return new Config($this->plugin->dataDir . $this->filename . ".yml", Config::YAML, array());
	}
}
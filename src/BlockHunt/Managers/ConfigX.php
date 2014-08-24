<?php
namespace HideHunt\Managers;

use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class ConfigX{
	private $plugin;
	private $filename;
	
	public function __construct(Plugin $plugin, $filename)
	{
		parent::__construct($plugin);
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
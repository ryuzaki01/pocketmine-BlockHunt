<?php
namespace BlockHunt\Managers;

use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

use BlockHunt\BlockHunt;

class ConfigM {
	private $plugin;
	public $location;
	public $filename;
	public $file;
	public $fileC;
	
	public function __construct(BlockHunt $plugin, $filename, $location = "")
	{
		$this->plugin = $plugin;
		$this->filename = $filename;
		$this->location = $location;
		$this->checkFile();
		$this->fileC = new Config($this->plugin->dataDir . $this->filename . ".yml", Config::YAML, array());
	}
	
	public function checkFile(){
		if (!file_exists($this->plugin->dataDir . $this->filename.".yml")) {
			$this->plugin->getLogger()->info(TextFormat::RED ."Can't find ".$this->filename." creating new one !");
			$this->fileC = new Config($this->plugin->dataDir . $this->filename . ".yml", Config::YAML, array());
			$this->fileC->save();
			if($this->location != ""){
				$this->plugin->storage->newFiles[] = $this->location . $this->filename . ".yml";
			} else {
				$this->plugin->storage->newFiles[] = $this->plugin->dataDir . $this->filename . ".yml";
			}
		}
	}
	
	public static function newFiles() {
		$this->setDefaults();
		foreach($this->plugin->storage->newFiles as $fileName) {
			MessageM.sendMessage(null, "%TAG%WCouldn't find '%A%fileName%.yml%W' creating new one.", "fileName-" . $fileName);
		}

		$this->plugin->storage->newFiles = [];
	}
	
	public static function setDefaults() {
		foreach(ConfigC::values() as $value) {
			$value->config->load();
			if ($value->config->get($value->location) == null) {
				$value->config->set($value->location, $value->value);
				$value->config->save();
			}
		}
	}

	
	public function load(){
		$this->checkFile();
		if (file_exists($this->plugin->dataDir . $this->filename.".yml")) {
			try {
				$this->fileC->load($this->plugin->dataDir . $this->filename.".yml");
			} catch (Exception $e) {
				$this->plugin->getLogger()->info('Caught exception: ',  $e->getMessage(), "\n");
			}
		}
	}
	
	public function get($params){
		return $this->fileC->get($params);
	}
	
	public function getAll(){
		return $this->fileC->getAll();
	}
	
	public function set($params, $val){
		return $this->fileC->set($params, $val);
	}
	
	public function save(){
		return $this->fileC->save();
	}
	
	public function reload(){
		return $this->fileC->reload();
	}
}
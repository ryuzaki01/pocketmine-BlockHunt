<?php
namespace HideHunt;

use HideHunt\Managers\ConfigX;

class Storage {
	private $plugin;

	public function __construct(Plugin $plugin){
		parent::__construct($plugin);
		$this->plugin = $plugin;
	}
	
	public static $newFiles = array();
	public static $commands = array();
	public static $config = new ConfigX($this->plugin, "config");
	public static $messages = new ConfigX($this->plugin, "messages");
	public static $arenas = new ConfigX($this->plugin, "arenas");
	public static $signs = new ConfigX($this->plugin, "signs");
	public static $shop = new ConfigX($this->plugin, "shop");
	public static $pos1 = array();
	public static $pos2 = array();
	public static $arenaList = array();
	public static $random = new Math.random();
	public static $seekertime = array();
	public static $pData = array();
	public static $choosenBlock = array();
	public static $choosenSeeker = array();
	public static $pBlock = array();
	public static $moveLoc = array();
	public static $hiddenLoc = array();
	public static $hiddenLocWater = array();
}
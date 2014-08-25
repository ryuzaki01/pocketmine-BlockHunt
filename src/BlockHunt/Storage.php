<?php
namespace BlockHunt;

use BlockHunt\BlockHunt;
use BlockHunt\Managers\ConfigM;

class Storage {
	private $plugin;
	public $newFiles = array();
	public $commands = array();
	public $messages;
	public $arenas;
	public $signs;
	public $shop;
	public $pos1 = array();
	public $pos2 = array();
	public $arenaList = array();
	public $random;
	public $seekertime = array();
	public $pData = array();
	public $choosenBlock = array();
	public $choosenSeeker = array();
	public $pBlock = array();
	public $moveLoc = array();
	public $hiddenLoc = array();
	public $hiddenLocWater = array();
	
	public function __construct(BlockHunt $plugin){
		$this->plugin = $plugin;
		$this->messages = new ConfigM($this->plugin, "messages");
		$this->arenas = new ConfigM($this->plugin, "arenas");
		$this->signs = new ConfigM($this->plugin, "signs");
		$this->shop = new ConfigM($this->plugin, "shop");
	}
}
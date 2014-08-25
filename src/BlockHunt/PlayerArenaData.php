<?php
namespace BlockHunt;

use pocketmine\level\Position;

class PlayerArenaData {
	public $pGameMode;
	public $pInventory = array();
	public $pArmor = array();
	public $pEXP;
	public $pEXPL;
	public $pHealth;
	public $pFood;
	public $pPotionEffects;
	public $pFlying;

	public PlayerArenaData (Position $pLocation, $pGameMode, $pInventory, $pArmor, $pEXP, $pEXPL, $pHealth, $pFood, $pPotionEffects, $pFlying) {
		$this->pGameMode = $pGameMode;
		$this->pInventory = $pInventory;
		$this->pArmor = $pArmor;
		$this->pEXP = $pEXP;
		$this->pEXPL = $pEXPL;
		$this->pHealth = $pHealth;
		$this->pFood = $pFood;
		$this->pPotionEffects = $pPotionEffects;
		$this->pFlying = $pFlying;
	}
}
?>
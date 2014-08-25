<?php
namespace BlockHunt\Handlers;

use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\inventory\PlayerInventory;

//use BlockHunt\Handlers\ScoreboardHandler;
use BlockHunt\BlockHunt;
use BlockHunt\Entities\Arena;
use BlockHunt\PlayerArenaData;

class ArenaHandler {
	private $plugin;

	public function __construct(BlockHunt $plugin){
		$this->plugin = $plugin;
	}
	
	public function loadArenas(){
		unset($this->plugin->storage->arenaList);
		foreach($this->plugin->storage->arenas as $arenaname => $arenaval) {
			$this->plugin->storage->arenaList[] = $this->plugin->storage->arenas->get($arenaname);
		}
		foreach($this->plugin->storage->arenaList as $arena) {
			//ScoreboardHandler::createScoreboard($arena->;
		}
	}

	public static function sendMessage(Arena $arena, $message, $vars)
	{
	  foreach($arena->playersInArena as $player)
	 {
	   $pMessage = str_replace(array("%player%"), $player->getName(), $message);
	   $player->sendMessage(MessageM::replaceAll($pMessage, $vars));
	 }
	}

	public static function sendFMessage(Arena $arena, $location, $vars)
	{
	 foreach($arena->playersInArena as $player)
	 {
	   $pMessage = str_replace("%player%", $player->getName(), $location->config->get($location->location));
	   $player->sendMessage(MessageM::replaceAll($pMessage, $vars));
	 }
	}

	public static function playerJoinArena(Player $player, $arenaname)
	{
	 $found = false;
	 $alreadyJoined = false;
	 foreach($this->plugin->storage->$arena->arenaList as $arena) {
	   if (($arena->playersInArena != null) && 
		 ($arena->playersInArena->contains($player))) {
		 $alreadyJoined = true;
	   }
	 }
	 if (!$alreadyJoined)
	 {
	   foreach($this->plugin->storage->$arena->arenaList as $arena) {
		 if (strtolower($arena->arenaname) == strtolower($arenaname))
		 {
		   $found = true;
		   if ($arena->disguiseBlocks->isEmpty())
		   {
			 MessageM::sendFMessage($player, $this->plugin->getConfig()->get("error")["joinNoBlocksSet"], []);
		   }
		   else
		   {
			 $inventoryempty = true;
			 foreach($player->getInventory() as $invitem) {
			   if (($invitem != null) && ($invitem->getID() != 0)) {
				 $inventoryempty = false;
			   }
			 }
			 $localObject;
			 $j = count($localObject = $player->getInventory()->getArmorContents());
			 for ($i = 0; $i < $j; $i++)
			 {
			   $invitem = $localObject[$i];
			   if ($invitem->getID() != 0) {
				 $inventoryempty = false;
			   }
			 }
			 if ($this->plugin->getConfig()->get("requireInventoryClearOnJoin") && (!$inventoryempty))
			 {
			   MessageM::sendFMessage(player, $this->plugin->getConfig()->get("error")["joinInventoryNotEmpty"]);
			   return;
			 }
			 $zero = new Position(0, 0, 0, $player->getLevel());
			 if (($arena->lobbyWarp != null) && ($arena->hidersWarp != null) && ($arena->seekersWarp != null) && ($arena->spawnWarp != null))
			 {
			   if ((!$arena->lobbyWarp == $zero) && 
				 (!$arena->hidersWarp == $zero) && 
				 (!$arena->seekersWarp == $zero) && 
				 (!$arena->spawnWarp == $zero))
			   {
				 if (($arena->gameState == ArenaState::WAITING) || 
				   ($arena->gameState == ArenaState::STARTING))
				 {
				   if ($arena->playersInArena.size() >= $arena->maxPlayers) {
					 if (!$player-hasPermission('blockhunt.moderator.joinfull'))
					 {
					   MessageM::sendFMessage(player, $this->plugin->storage->messages->get("error")["joinFull"], []);
					   return;
					 }
				   }
				   $arena->playersInArena.add(player);
				   
				   $pad = new PlayerArenaData(
					 $player->getLocation(), 
					 $player->getGameMode(),
					 $player->getInventory()->getContents(),
					 $player->getInventory()->getArmorContents(), 
					 $player->getExp(),
					 $player->getLevel(), 
					 $player->getHealth(), 
					 $player->getFoodLevel(), 
					 $player->getActivePotionEffects(), 
					 $player->getAllowFlight());
				   
				   $this->plugin->storage->pData[] = array($player, $pad);
				   
				   $player->teleport($arena->lobbyWarp);
				   $player->setGameMode(0);
				   
				   // $localObject = $player->getActivePotionEffects().iterator();
				   // while (((Iterator)localObject).hasNext())
				   // {
					 // PotionEffect pe = (PotionEffect)((Iterator)localObject).next();
					 // $player->removePotionEffect(pe.getType());
				   // }
				   $player->setFoodLevel(20);
				   $player->setHealth(20);
				   $player->setLevel($arena->timer);
				   $player->setExp(0.0);
				   $player->getInventory()->clearAll();
				   $player->getInventory()->setHelmet(Item::AIR);
				   $player->getInventory()->setChestplate(Item::AIR);
				   $player->getInventory()->setLeggings(Item::AIR);
				   $player->getInventory()->setBoots(Item::AIR);
				   $player->setFlying(false);
				   $player->setAllowFlight(false);
				   if ($this->plugin->getConfig()->get("shop")["blockChooserv1Enabled"] && (($this->plugin->storage->shop->get($player->getName().".blockchooser") != null) || $player-hasPermission('blockhunt.admin.blockchooser')))
				   {
					$shopBlockChooser = new Item($this->plugin->getConfig()->get("shop")["blockChooserv1IDname"], 0, 1,  MessageM::replaceAll($this->plugin->getConfig()->get("shop")["blockChooserv1Name"]));
					
					 $player->getInventory()->addItem($shopBlockChooser);
				   }
				   if ($this->plugin->getConfig()->get("shop")["BlockHuntPassv2Enabled"] && ($this->plugin->storage->shop.get($player->getName().".blockhuntpass") != 0))
				   {
					 $shopBlockHuntPass = new Item($this->plugin->getConfig()->get("shop")["BlockHuntPassv2IDName"], 0, 1,  MessageM::replaceAll($this->plugin->getConfig()->get("shop")["BlockHuntPassv2Name"]));
					 
					 $player->getInventory().addItem($shopBlockHuntPass);
				   }
				   
				   $player->updateInventory();
				   
				   DisguiseAPI.undisguiseToAll(player);
				   
				   sendFMessage($arena, $this->plugin->storage->message->get("normal")["joinJoinedArena"], [ "playername-" . $player->getName(), "1-" . count($arena->playersInArena), "2-" . $arena->maxPlayers ]);
				   if (count($arena->playersInArena) < $arena->minPlayers) {
					 sendFMessage($arena, $this->plugin->getConfig()->get("warning")["lobbyNeedAtleast"], [ "1-" . $arena->minPlayers ]);
				   }
				 }
				 else
				 {
				   MessageM::sendFMessage($player, $this->plugin->storage->messages->get("error")["joinArenaIngame"], []);
				 }
			   }
			   else {
				 MessageM::sendFMessage($player, $this->plugin->storage->messages->get("error")["joinWarpsNotSet"], []);
			   }
			 }
			 else {
			   MessageM::sendFMessage(player, $this->plugin->storage->messages->get("error")["joinWarpsNotSet"], []);
			 }
		   }
		 }
	   }
	 }
	 else
	 {
	   MessageM::sendFMessage(player, $this->plugin->storage->messages->get("error")['joinAlreadyJoined'], []);
	   return;
	 }
	 if (!$found) {
	   MessageM::sendFMessage(player, $this->plugin->storage->messages->get("error")["noArena"], ["name-" .$arenaname]);
	 }
		
	  SignsHandler($this->plugin)->updateSigns();
	}

	public static function playerLeaveArena(Player $player, $message, $cleanup)
	{
	 $arena = null;
	 foreach($this->plugin->storage->arenaList as $arena2) {
	   if (($arena->playersInArena != null) && (in_array($player, $arena->playersInArena))) {
			$arena = $arena2;
	   }
	 }
	 if ($arena != null)
	 {
	   if ($cleanup)
	   {
		 unset($arena->playersInArena[$player]);
		 if (in_array($player, $arena->seekers)) {
		   unset($arena->seekers[$player]);
		 }
		 if (($arena->playersInArena.size() < $arena->minPlayers) && 
		   ($arena->gameState.equals(ArenaState::STARTING)))
		 {
		   $arena->gameState = ArenaState::WAITING;
		   $arena->timer = 0;
		   
		   sendFMessage($arena, $this->plugin->storage->messages->get("warning")["lobbyNeedAtleast"], ["1-".$arena->minPlayers ]);
		 }
		 if (($arena->playersInArena.size() <= 2) && 
		   ($arena->gameState == ArenaState::INGAME)) {
		   if (count($arena->seekers) >= count($arena->playersInArena)) {
			$this->seekersWin($arena);
		   } else {
			 $this->hidersWin($arena);
		   }
		 }
		 if (count($arena->seekers) >= count($arena->playersInArena)) {
			$this->seekersWin($arena);
		 }
		 if ((count($arena->seekers) <= 0) && ($arena->gameState == ArenaState::INGAME))
		 {
		   $seeker = $arena->playersInArena->get(mt_rand($this->plugin->storage->random, count($arena->playersInArena) - 1));
		   sendFMessage($arena, $this->plugin->storage->messages->get("warning")["ingameNEWSeekerChoosen"], ["seeker-" . $seeker->getName() ]);
		   sendFMessage($arena, $this->plugin->storage->messages->get("normal")["ingameSeekerChoosen"], ["seeker-" .$seeker->getName() ]);
			DisguiseAPI::undisguiseToAll($seeker);
		   foreach($this->plugin->getServer->getOnlinePlayers() as $pl) {
			 $pl->showPlayer($seeker);
		   }
		   $seeker->getInventory()->clearAll();
		   $arena->seekers[] = $seeker;
		   $seeker->teleport($arena->seekersWarp);
		   $this->plugin->storage->seekertime[$seeker] = $arena->waitingTimeSeeker;
		 }
	   }
		$pad = new PlayerArenaData(null, null, null, null, null, null, null, null, null, false);
	   if ($this->plugin->storage->pData[$player] != null) {
		 $pad = $this->plugin->storage->pData[$player];
	   }
	   $player->getInventory()->clearAll();
	   $player->getInventory()->setContents($pad->pInventory);
	   $player->getInventory()->setArmorContents($pad->pArmor);
	   $player->setExp(floatval($pad->pEXP));
	   $player->setLevel(intval($pad->pEXPL));
	   $player->setHealth(floatval($pad->pHealth));
	   $player->setFoodLevel(intval($pad->pFood));
	   $player->addPotionEffects($pad->pPotionEffects);
	   $player->teleport($arena->spawnWarp);
	   $player->setGameMode($pad->pGameMode);
	   $player->setAllowFlight($pad->pFlying);
	   if ($player->getAllowFlight()) {
		 $player->setFlying(true);
	   }
	   unset($this->plugin->storage->pData[$player]);
	   foreach($this->plugin->getServer->getOnlinePlayers() as $pl)
	   {
		 $pl->showPlayer($player);
		 if (($this->plugin->storage->hiddenLoc[$player] != null) && ($this->plugin->storage->hiddenLocWater[$player] != null))
		 {
		   $pBlock = ($this->plugin->storage->hiddenLoc[$player]);
		   if ($this->plugin->storage->hiddenLocWater[$player]) {
			 $pl->setBlock(new Vector3($pBlock->getX(), $pBlock->getY(), $pBlock->getZ()), Block::STILL_WATER, false, true);
		   } else {
			 $pl->setBlock(new Vector3($pBlock->getX(), $pBlock->getY(), $pBlock->getZ()), Block::AIR, false, true);
		   }
		 }
		 DisguiseAPI::undisguiseToAll($player);
	   }
	   //ScoreboardHandler::removeScoreboard($player);
	   
	   MessageM::sendFMessage(player, $this->plugin->storage->messages->get("normal")["leaveYouLeft"], []);
	   if ($message) {
		 sendFMessage($arena, $this->plugin->storage->messages->get("normal")["leaveLeftArena"], ["playername-" . $player->getName(), "1-" . $arena->playersInArena.size(), "2-" . $arena->maxPlayers ]);
	   }
	 }
	 else
	 {
	   if ($message) {
		 MessageM::sendFMessage($player, $this->plugin->storage->messages->get("error")["leaveNotInArena"], []);
	   }
	   return;
	 }
	 SignsHandler($this->plugin)->updateSigns();
	}

	public static function seekersWin(Arena $arena)
	{
	 sendFMessage($arena, $this->plugin->storage->messages->get("normal")["winSeekers"], []);
	 foreach($arena->playersInArena as $player) {
	   if ($arena->seekersWinCommands != null)
	   {
		 foreach($arena->seekersWinCommands as $command) {
		   $this->plugin->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("%player%", $player->getName(), $command));
		 }
		 if ($this->plugin->getConfig()->get("vaultSupport"))
		 {
		   if ($this->plugin->econ != null)
		   {
			 $this->plugin->econ->depositPlayer($player->getName(), $arena->seekersTokenWin);
			 MessageM::sendFMessage($player,  $this->plugin->storage->messages->get("normal")["addedVaultBalance"], ["amount-" .$arena->seekersTokenWin ]);
		   }
		 }
		 else
		 {
		   if ($this->plugin->storage->shop->get($player->getName() . ".tokens") == null)
		   {
			 $this->plugin->storage->shop->set($player->getName() . ".tokens", 0);
			 $this->plugin->storage->shop->save();
		   }
		   $playerTokens = $this->plugin->storage->shop->get($player->getName() . ".tokens");
		   $this->plugin->storage->shop->set($player->getName() . ".tokens",  intval($playerTokens . $arena->seekersTokenWin));
		   $this->plugin->storage->shop->save();
		   
		   MessageM::sendFMessage(player, $this->plugin->storage->messages->get("normal")["addedToken"], ["amount-" . $arena->seekersTokenWin ]);
		 }
	   }
	 }
	 $arena->seekers = [];
	 foreach($arena->playersInArena as $player)
	 {
	   playerLeaveArena($player, false, false);
	   //$player->playSound($player->getLocation(), Sound.LEVEL_UP, 1.0F, 1.0F);
	 }
	 $arena->gameState = ArenaState::WAITING;
	 $arena->timer = 0;
	 $arena->playersInArena = [];
	}

	public static function hidersWin(Arena $arena)
	{
	 sendFMessage($arena, $this->plugin->storage->messages->get("normal")["winHiders"],  []);
	 foreach($arena->playersInArena as $player) {
	   if ((!in_array($player, $arena->seekers)) && ($arena->hidersWinCommands != null))
	   {
		 foreach($arena->hidersWinCommands as $command) {
			$this->plugin->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("%player%", $player->getName(), $command));
		 }
		 if ($this->plugin->storage->config->get("vaultSupport"))
		 {
		   if (($this->plugin->econ != null) && (!in_array($player, $arena->seekers)))
		   {
			 $this->plugin->econ->depositPlayer($player->getName(), $arena->hidersTokenWin);
			 MessageM::sendFMessage(player, $this->plugin->storage->messages->get("normal")["addedVaultBalance"], ["amount-" . $arena->hidersTokenWin ]);
		   }
		 }
		 else
		 {
		   if ($this->plugin->storage->shop->get($player->getName() . ".tokens") == null)
		   {
			 $this->plugin->storage->shop->set($player->getName() . ".tokens", 0);
			 $this->plugin->storage->shop->save();
		   }
		   $playerTokens = $this->plugin->storage->shop->get($player->getName() . ".tokens");
		   $this->plugin->storage->shop.getFile().set($player->getName() . ".tokens", intval($playerTokens . $arena->hidersTokenWin));
		   $this->plugin->storage->shop->save();
		   
		   MessageM::sendFMessage(player, $this->plugin->storage->messages->get("normal")["addedToken"], ["amount-" . $arena->hidersTokenWin ]);
		 }
	   }
	 }
	 $arena->seekers = [];
	 foreach($arena->playersInArena as $player)
	 {
	   playerLeaveArena(player, false, false);
	   //$player->playSound($player->getLocation(), Sound.LEVEL_UP, 1.0F, 1.0F);
	 }
	 $arena->gameState = ArenaState::WAITING;
	 $arena->timer = 0;
	 $arena->playersInArena = [];
	}

	public static function stopArena(Arena $arena)
	{
		sendFMessage($arena, $this->plugin->storage->messages->get("warning")["arenaStopped"], []);

		$arena->seekers = [];
		foreach($arena->playersInArena as $player)
		{
		$this->playerLeaveArena($player, false, false);
		//$player->playSound($player->getLocation(), Sound.LEVEL_UP, 1.0F, 1.0F);
		}
		$arena->gameState = ArenaState::WAITING;
		$arena->timer = 0;
		$arena->playersInArena = [];
	}
}

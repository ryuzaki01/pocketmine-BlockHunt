<?php
namespace BlockHunt\Handlers;

use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\level\Position;
use pocketmine\inventory\PlayerInventory;

//use BlockHunt\Handlers\ScoreboardHandler;
use BlockHunt\BlockHunt;
use BlockHunt\Entities\Arena;
use BlockHunt\PlayerArenaData;

class ArenaHandler {
	private $plugin;

	public function __construct(BlockHunt $plugin){
		parent::__construct($plugin);
		$this->plugin = $plugin;
	}
	
	public static function loadArena()
	{
		$this->plugin->storage->arenaList->clear();
		foreach($this->plugin->storage->arenas->getFile()->getKeys(false) as $arenaname) {
			$this->plugin->storage->arenaList->add($this->plugin->storage->arenas->getFile()->get($arenaname));
		}
		foreach($this->plugin->storage->$arena->arenaList as $arena {
			//ScoreboardHandler::createScoreboard($arena->;
		}
	}

	public static function sendMessage(Arena $arena $message, $vars)
	{
	  foreach($arena->playersInArena as $player)
	 {
	   $pMessage = str_replace(array("%player%"), $player->getName(), $message);
	   $player->sendMessage(MessageM::replaceAll($pMessage, $vars));
	 }
	}

	public static function sendFMessage(Arena $arena $location, $vars)
	{
	 foreach($arena->playersInArena as $player)
	 {
	   $pMessage = $location->config->getFile()->get($location->location)->toString()->replaceAll("%player%", player->getName());
	   $player->sendMessage(MessageM::replaceAll($pMessage, vars));
	 }
	}

	public static function playerJoinArena(Player $player, $arenaname)
	{
	 $found = false;
	 $alreadyJoined = false;
	 foreach($this->plugin->storage->$arena->arenaList as $arena {
	   if (($arena->playersInArena != null) && 
		 ($arena->playersInArena->contains($player))) {
		 $alreadyJoined = true;
	   }
	 }
	 if (!$alreadyJoined)
	 {
	   foreach($this->plugin->storage->$arena->arenaList as $arena {
		 if (strtolower($arena->arenaname) == strtolower($arenaname))
		 {
		   $found = true;
		   if ($arena->disguiseBlocks->isEmpty())
		   {
			 MessageM::sendFMessage($player, $this->plugin->getConfig()->get("error")["joinNoBlocksSet"], new String[0]);
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
			 for (int $i = 0; $i < $j; $i++)
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
				 if (($arena->gameState == Arena::ArenaState::WAITING) || 
				   ($arena->gameState == Arena::ArenaState::STARTING))
				 {
				   if ($arena->playersInArena.size() >= $arena->maxPlayers) {
					 if (!$player-hasPermission(PermissionsC::Permissions::joinfull))
					 {
					   MessageM::sendFMessage(player, $this->plugin->getConfig()->get("error")["joinFull"], new String[0]);
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
				   $player->setGameMode(GameMode.SURVIVAL);
				   
				   localObject = $player->getActivePotionEffects().iterator();
				   while (((Iterator)localObject).hasNext())
				   {
					 PotionEffect pe = (PotionEffect)((Iterator)localObject).next();
					 $player->removePotionEffect(pe.getType());
				   }
				   $player->setFoodLevel(20);
				   $player->setHealth(20);
				   $player->setLevel($arena->timer);
				   $player->setExp(0.0F);
				   $player->getInventory().clear();
				   $player->getInventory().setHelmet(
					 new ItemStack(Material.AIR));
				   $player->getInventory().setChestplate(
					 new ItemStack(Material.AIR));
				   $player->getInventory().setLeggings(
					 new ItemStack(Material.AIR));
				   $player->getInventory().setBoots(
					 new ItemStack(Material.AIR));
				   $player->setFlying(false);
				   $player->setAllowFlight(false);
				   if ((((Boolean)$this->plugin->storage->config.get($this->plugin->getConfig()->get("shop")["blockChooserv1Enabled"] && (
					 ($this->plugin->storage->shop.getFile().get(
					 $player->getName() + 
					 ".blockchooser") != null) || 
					 



					 ($player-hasPermission( PermissionsC::Permissions::shopblockchooser, Boolean.valueOf(false)))))
				   {
					 $shopBlockChooser = Item::fromString($this->plugin->getConfig()->get("shop")["blockChooserv1IDname"]);
					 $shopBlockChooser_IM = shopBlockChooser->getDamage();
					 $shopBlockChooser_IM->setDisplayName(MessageM::replaceAll($this->plugin->getConfig()->get("shop")["blockChooserv1Name"], new String[0]));
					 $lores =  $this->plugin->getConfig()->get("shop")["blockChooserv1Description"];
					 $lores2 = array();
					 foreach($lores as $lore) {
					   $lores2[] = MessageM::replaceAll($lore, new String[0]));
					 }
					 $shopBlockChooser_IM->setLore($lores2);
					 $shopBlockChooser->setItemMeta($shopBlockChooser_IM);
					 
					 $player->getInventory()->addItem($shopBlockChooser);
				   }
				   if ((($this->plugin->storage->config.get($this->plugin->getConfig()->get("shop")["BlockHuntPassv2Enabled") && ($this->plugin->storage->shop.getFile().getInt(
					 $player->getName() + 
					 ".blockhuntpass") != 0))
				   {
					 ItemStack shopBlockHuntPass = new ItemStack(
					   Material.getMaterial((String)$this->plugin->storage->config
					   .get($this->plugin->getConfig()->get("shop")["BlockHuntPassv2IDName)), 
					   1);
					 ItemMeta shopBlockHuntPass_IM = shopBlockHuntPass
					   .getItemMeta();
					 shopBlockHuntPass_IM
					   .setDisplayName(
					   MessageM::replaceAll((String)$this->plugin->storage->config
					   .get($this->plugin->getConfig()->get("shop")["BlockHuntPassv2Name), new String[0]));
					 List<String> lores = $this->plugin->storage->config
					   .getFile()
					   .getStringList(
					   $this->plugin->getConfig()->get("shop")["BlockHuntPassv2Description.location);
					 List<String> lores2 = new ArrayList();
					 for (String lore : lores) {
					   lores2.add(
						 MessageM::replaceAll(lore, new String[0]));
					 }
					 shopBlockHuntPass_IM.setLore(lores2);
					 shopBlockHuntPass
					   .setItemMeta(shopBlockHuntPass_IM);
					 shopBlockHuntPass
					   .setAmount($this->plugin->storage->shop
					   .getFile()
					   .getInt(player
					   .getName() + 
					   ".blockhuntpass"));
					 
					 $player->getInventory().addItem(new ItemStack[] {
					   shopBlockHuntPass });
				   }
				   $player->updateInventory();
				   
				   DisguiseAPI.undisguiseToAll(player);
				   
				   sendFMessage($arena 
					 $this->plugin->getConfig()->get("normal_joinJoinedArena, new String[] {
					 "playername-" + $player->getName(), 
					 "1-" + $arena->playersInArena.size(), 
					 "2-" + $arena->maxPlayers });
				   if ($arena->playersInArena.size() < $arena->minPlayers) {
					 sendFMessage(
					   $arena 
					   $this->plugin->getConfig()->get("warning_lobbyNeedAtleast, new String[] {
					   "1-" + $arena->minPlayers });
				   }
				 }
				 else
				 {
				   MessageM::sendFMessage(player, 
					 $this->plugin->getConfig()->get("error_joinArenaIngame, new String[0]);
				 }
			   }
			   else {
				 MessageM::sendFMessage(player, 
				   $this->plugin->getConfig()->get("error_joinWarpsNotSet, new String[0]);
			   }
			 }
			 else {
			   MessageM::sendFMessage(player, 
				 $this->plugin->getConfig()->get("error_joinWarpsNotSet, new String[0]);
			 }
		   }
		 }
	   }
	 }
	 else
	 {
	   MessageM::sendFMessage(player, $this->plugin->getConfig()->get("error_joinAlreadyJoined, new String[0]);
	   return;
	 }
	 if (!found) {
	   MessageM::sendFMessage(player, $this->plugin->getConfig()->get("error_noArena, new String[] {"name-" + 
		 $arena->ame });
	 }
	 SignsHandler.updateSigns();
	}

	public static function playerLeaveArena(Player player, boolean message, boolean cleanup)
	{
	 Arena $arena->= null;
	 for (Arena $arena : $this->plugin->storage->arenaList) {
	   if (($arena->.playersInArena != null) && 
		 ($arena->.playersInArena.contains(player))) {
		 $arena->= $arena->;
	   }
	 }
	 if ($arena->!= null)
	 {
	   if (cleanup)
	   {
		 $arena->playersInArena.remove(player);
		 if ($arena->seekers.contains(player)) {
		   $arena->seekers.remove(player);
		 }
		 if (($arena->playersInArena.size() < $arena->minPlayers) && 
		   ($arena->gameState.equals(Arena::ArenaState::STARTING)))
		 {
		   $arena->gameState = Arena::ArenaState::WAITING;
		   $arena->timer = 0;
		   
		   sendFMessage($arena 
			 $this->plugin->getConfig()->get("warning_lobbyNeedAtleast, new String[] {"1-" + 
			 $arena->minPlayers });
		 }
		 if (($arena->playersInArena.size() <= 2) && 
		   ($arena->gameState == Arena::ArenaState::INGAME)) {
		   if ($arena->seekers.size() >= $arena->playersInArena.size()) {
			 seekersWin($arena->;
		   } else {
			 hidersWin($arena->;
		   }
		 }
		 if ($arena->seekers.size() >= $arena->playersInArena.size()) {
		   seekersWin($arena->;
		 }
		 if (($arena->seekers.size() <= 0) && 
		   ($arena->gameState == Arena::ArenaState::INGAME))
		 {
		   Player seeker = (Player)$arena->playersInArena.get($this->plugin->storage->random
			 .nextInt($arena->playersInArena.size()));
		   sendFMessage($arena 
			 $this->plugin->getConfig()->get("warning_ingameNEWSeekerChoosen, new String[] {"seeker-" + 
			 seeker.getName() });
		   sendFMessage($arena 
			 $this->plugin->getConfig()->get("normal_ingameSeekerChoosen, new String[] {"seeker-" + 
			 seeker.getName() });
		   DisguiseAPI.undisguiseToAll(seeker);
		   for (Player pl : Bukkit.getOnlinePlayers()) {
			 pl.showPlayer(seeker);
		   }
		   seeker.getInventory().clear();
		   $arena->seekers.add(seeker);
		   seeker.teleport($arena->seekersWarp);
		   $this->plugin->storage->seekertime.put(seeker, Integer.valueOf($arena->waitingTimeSeeker));
		 }
	   }
	   PlayerArenaData pad = new PlayerArenaData(null, null, null, null, 
		 null, null, null, null, null, false);
	   if ($this->plugin->storage->pData.get(player) != null) {
		 pad = (PlayerArenaData)$this->plugin->storage->pData.get(player);
	   }
	   $player->getInventory().clear();
	   $player->getInventory().setContents(pad.pInventory);
	   $player->getInventory().setArmorContents(pad.pArmor);
	   $player->updateInventory();
	   $player->setExp(pad.pEXP.floatValue());
	   $player->setLevel(pad.pEXPL.intValue());
	   $player->setHealth(pad.pHealth.doubleValue());
	   $player->setFoodLevel(pad.pFood.intValue());
	   $player->addPotionEffects(pad.pPotionEffects);
	   $player->teleport($arena->spawnWarp);
	   $player->setGameMode(pad.pGameMode);
	   $player->setAllowFlight(pad.pFlying);
	   if ($player->getAllowFlight()) {
		 $player->setFlying(true);
	   }
	   $this->plugin->storage->pData.remove(player);
	   for (Player pl : Bukkit.getOnlinePlayers())
	   {
		 pl.showPlayer(player);
		 if (($this->plugin->storage->hiddenLoc.get(player) != null) && 
		   ($this->plugin->storage->hiddenLocWater.get(player) != null))
		 {
		   Block pBlock = ((Location)$this->plugin->storage->hiddenLoc.get(player)).getBlock();
		   if (((Boolean)$this->plugin->storage->hiddenLocWater.get(player)).booleanValue()) {
			 pl.sendBlockChange(pBlock.getLocation(), 
			   Material.STATIONARY_WATER, (byte)0);
		   } else {
			 pl.sendBlockChange(pBlock.getLocation(), 
			   Material.AIR, (byte)0);
		   }
		 }
		 DisguiseAPI.undisguiseToAll(player);
	   }
	   ScoreboardHandler.removeScoreboard(player);
	   
	   MessageM::sendFMessage(player, $this->plugin->getConfig()->get("normal_leaveYouLeft, new String[0]);
	   if (message) {
		 sendFMessage($arena $this->plugin->getConfig()->get("normal_leaveLeftArena, new String[] {
		   "playername-" + $player->getName(), "1-" + 
		   $arena->playersInArena.size(), "2-" + 
		   $arena->maxPlayers });
	   }
	 }
	 else
	 {
	   if (message) {
		 MessageM::sendFMessage(player, $this->plugin->getConfig()->get("error_leaveNotInArena, new String[0]);
	   }
	   return;
	 }
	 SignsHandler.updateSigns();
	}

	public static function seekersWin(Arena $arena->
	{
	 sendFMessage($arena $this->plugin->getConfig()->get("normal_winSeekers, new String[0]);
	 for (Player player : $arena->playersInArena) {
	   if ($arena->seekersWinCommands != null)
	   {
		 for (String command : $arena->seekersWinCommands) {
		   Bukkit.dispatchCommand(Bukkit.getConsoleSender(), 
			 command.replaceAll("%player%", $player->getName()));
		 }
		 if ($this->plugin->storage->config.getFile().getBoolean("vaultSupport"))
		 {
		   if (BlockHunt.econ != null)
		   {
			 BlockHunt.econ.depositPlayer($player->getName(), 
			   $arena->seekersTokenWin);
			 MessageM::sendFMessage(player, 
			   $this->plugin->getConfig()->get("normal_addedVaultBalance, new String[] {"amount-" + 
			   $arena->seekersTokenWin });
		   }
		 }
		 else
		 {
		   if ($this->plugin->storage->shop.getFile().get($player->getName() + ".tokens") == null)
		   {
			 $this->plugin->storage->shop.getFile().set($player->getName() + ".tokens", Integer.valueOf(0));
			 $this->plugin->storage->shop.save();
		   }
		   int playerTokens = $this->plugin->storage->shop.getFile().getInt(
			 $player->getName() + ".tokens");
		   $this->plugin->storage->shop.getFile().set($player->getName() + ".tokens", 
			 Integer.valueOf(playerTokens + $arena->seekersTokenWin));
		   $this->plugin->storage->shop.save();
		   
		   MessageM::sendFMessage(player, $this->plugin->getConfig()->get("normal_addedToken, new String[] {
			 "amount-" + $arena->seekersTokenWin });
		 }
	   }
	 }
	 $arena->seekers.clear();
	 for (Player player : $arena->playersInArena)
	 {
	   playerLeaveArena(player, false, false);
	   $player->playSound($player->getLocation(), Sound.LEVEL_UP, 1.0F, 1.0F);
	 }
	 $arena->gameState = Arena::ArenaState::WAITING;
	 $arena->timer = 0;
	 $arena->playersInArena.clear();
	}

	public static function hidersWin(Arena $arena->
	{
	 sendFMessage($arena $this->plugin->getConfig()->get("normal_winHiders, new String[0]);
	 for (Player player : $arena->playersInArena) {
	   if ((!$arena->seekers.contains(player)) && 
		 ($arena->hidersWinCommands != null))
	   {
		 for (String command : $arena->hidersWinCommands) {
		   Bukkit.dispatchCommand(
			 Bukkit.getConsoleSender(), 
			 command.replaceAll("%player%", $player->getName()));
		 }
		 if ($this->plugin->storage->config.getFile().getBoolean("vaultSupport"))
		 {
		   if ((BlockHunt.econ != null) && 
			 (!$arena->seekers.contains(player)))
		   {
			 BlockHunt.econ.depositPlayer($player->getName(), 
			   $arena->hidersTokenWin);
			 MessageM::sendFMessage(player, 
			   $this->plugin->getConfig()->get("normal_addedVaultBalance, new String[] {
			   "amount-" + $arena->hidersTokenWin });
		   }
		 }
		 else
		 {
		   if ($this->plugin->storage->shop.getFile().get($player->getName() + ".tokens") == null)
		   {
			 $this->plugin->storage->shop.getFile().set($player->getName() + ".tokens", 
			   Integer.valueOf(0));
			 $this->plugin->storage->shop.save();
		   }
		   int playerTokens = $this->plugin->storage->shop.getFile().getInt(
			 $player->getName() + ".tokens");
		   $this->plugin->storage->shop.getFile().set($player->getName() + ".tokens", 
			 Integer.valueOf(playerTokens + $arena->hidersTokenWin));
		   $this->plugin->storage->shop.save();
		   
		   MessageM::sendFMessage(player, 
			 $this->plugin->getConfig()->get("normal_addedToken, new String[] {"amount-" + 
			 $arena->hidersTokenWin });
		 }
	   }
	 }
	 $arena->seekers.clear();
	 for (Player player : $arena->playersInArena)
	 {
	   playerLeaveArena(player, false, false);
	   $player->playSound($player->getLocation(), Sound.LEVEL_UP, 1.0F, 1.0F);
	 }
	 $arena->gameState = Arena::ArenaState::WAITING;
	 $arena->timer = 0;
	 $arena->playersInArena.clear();
	}

	public static function stopArena(Arena $arena->
	{
	 sendFMessage($arena $this->plugin->getConfig()->get("warning_$arena->topped, new String[0]);
	 
	 $arena->seekers->clear();
	 foreach($arena->playersInArena as $player)
	 {
	   $this->playerLeaveArena($player, false, false);
	   //$player->playSound($player->getLocation(), Sound.LEVEL_UP, 1.0F, 1.0F);
	 }
	 $arena->gameState = Arena::ArenaState::WAITING;
	 $arena->timer = 0;
	 $arena->playersInArena->clear();
	}
}

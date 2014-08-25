<?php
namespace BlockHunt;

use pocketmine\Player;
use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\inventory\PlayerInventory;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

// use BlockHunt\Listeners\OnBlockBreakEvent;
// use BlockHunt\Listeners\OnBlockPlaceEvent;
// use BlockHunt\Listeners\OnEntityDamageByEntityEvent;
// use BlockHunt\Listeners\OnEntityDamageEvent;
// use BlockHunt\Listeners\OnFoodLevelChangeEvent;
// use BlockHunt\Listeners\OnInventoryClickEvent;
// use BlockHunt\Listeners\OnInventoryCloseEvent;
// use BlockHunt\Listeners\OnPlayerCommandPreprocessEvent;
// use BlockHunt\Listeners\OnPlayerDropItemEvent;
// use BlockHunt\Listeners\OnPlayerInteractEvent;
// use BlockHunt\Listeners\OnPlayerMoveEvent;
// use BlockHunt\Listeners\OnPlayerQuitEvent;
use BlockHunt\Listeners\OnSignChangeEvent;
use BlockHunt\Tasks\ArenaObserverTask;
use BlockHunt\Handlers\ArenaHandler;
use BlockHunt\Storage;

class BlockHunt extends PluginBase implements Listener{
	public static $config = false;
	public static $dataDir = false;
	public $output = "";
	public $storage = false;
	
	public function onLoad(){
		$this->getLogger()->info(TextFormat::WHITE . "BlockHunt plugin has been loaded!");
	}
	
	public function onEnable(){
		@mkdir("plugins/BlockHunt");
		self::$dataDir = "plugins/BlockHunt/";
		
        $this->checkConfig();
		$this->storage = new Storage($this);
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnBlockBreakEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnBlockPlaceEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnEntityDamageByEntityEvent(), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnEntityDamageEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnFoodLevelChangeEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnInventoryClickEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnInventoryCloseEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnPlayerCommandPreprocessEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnPlayerDropItemEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnPlayerInteractEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnPlayerMoveEvent($this), $this);
		// $this->getServer()->getPluginManager()->registerEvents(new OnPlayerQuitEvent($this), $this);
		$this->getServer()->getPluginManager()->registerEvents(new OnSignChangeEvent($this), $this);
		
				
		//setupEconomy();
		
		//ArenaHandler::loadArenas();
		
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new ArenaObserverTask($this), 6000);

        $this->getLogger()->info(TextFormat::GREEN ."BlockHunt plugin has been enabled!");
    }
	
	public function onCommand(CommandSender $sender, Command $command, $label, array $params){
        $cmd = strtolower($command->getName());
		
		if(!($sender instanceof Player)){
			$sender->sendMessage(TextFormat::RED . "Please run this command in-game.\n");
			return false;
		}
		
		$data = $this->getData($sender);
		
		if(!$sender->isOp()){
			return false;
		}
		
		if($cmd == "hidehunt" || $cmd == "hh"){
			switch($params[0]){
				case 'info':
				
				break;
			}
		}
		
		if($this->output != ""){
			$sender->sendMessage($this->output);
			$this->output = "";
			return true;
		}
		return false;
	}

    public function onDisable(){
		if(count($this->storage->arenaList) > 0){
			foreach($this->storage->arenaList as $arena) {
				ArenaHandler::stopArena($arena);
			}
		}
		
        $this->getLogger()->info(TextFormat::RED . "BlockHunt plugin has been disabled!");
    }
	
	private function checkConfig(){
        $this->getConfig()->save();

        if(!$this->getConfig()->exists("chat")){
            $this->getConfig()->set("chat", array(
					tag => "[BlockHunt] ", 
					normal => "&b",
					warning => "&c",
					error => "&c",
					arg => "&e ",
					header => "&9",
					headerhigh => "%H_______.[ %A%header%%H ]._______"
			));
        } elseif(!$this->getConfig()->exists("commandEnabled")){
            $this->getConfig()->set("commandEnabled",  array(
					info => true, 
					help => true,
					reload => true,
					join => true,
					leave => true,
					'list' => true,
					shop => true,
					start => true,
					wand => true,
					create => true,
					set => true,
					setwarp => true,
					remove => true,
					tokens => true
			));
        } elseif(!$this->getConfig()->exists("wandIDname")){
            $this->getConfig()->set("wandIDname",  "STICK");
        } elseif(!$this->getConfig()->exists("wandName")){
            $this->getConfig()->set("wandName",  "%A&lBlockHunt%N''s selection wand");
        } elseif(!$this->getConfig()->exists("wandDescription")){
            $this->getConfig()->set("wandDescription",  array(
					"%NUse this item to select an arena for your arena.", 
					"%ALeft-Click%N to select point #1.",
					"%ARight-Click%N to select point #2.",
					"%NUse the create command to define your arena.",
					"%A/BlockHunt <help|h>"
			));
        } elseif(!$this->getConfig()->exists("commandEnabled")){
            $this->getConfig()->set("commandEnabled",  array(
					title => "%H&BlockHunt %NShop", 
					price => "%NPrice: %A%amount% %Ntokens.",
					blockChooserv1Enabled => true,
					blockChooserv1IDname => "BOOK",
					blockChooserv1Price => 3000,
					blockChooserv1Name => "%H&lBlock Chooser",
					blockChooserv1Description => array(
						"%NUse this item before the arena starts.",
						"%ARight-Click%N in the lobby and choose",
						"%Nthe block you want to be!",
						"&6Unlimited uses."
					),
					BlockHuntPassv2Enabled => true,
					BlockHuntPassv2IDName => NAME_TAG,
					BlockHuntPassv2Price => 150,
					BlockHuntPassv2Name => "%H&lBlockHunt Pass",
					BlockHuntPassv2Description => array(
						"%NUse this item before the arena starts.",
						"%ARight-Click%N in the lobby and choose",
						"%Nif you want to be a Hider or a Seeker!",
						"&61 time use."
					)
			));
        } elseif(!$this->getConfig()->exists("sign")){
            $this->getConfig()->set("sign",  array(
					LEAVE => array(
						"%H[BlockHunt%H]",
						"&4LEAVE",
						"&8Right-Click",
						"&8To leave."
					),
					SHOP => array(
						"%H[BlockHunt%H]",
						"&4SHOP",
						"&8Right-Click",
						"&8To shop."
					),
					WAITING => array(
						"%H[BlockHunt%H]",
						"&4SHOP",
						"%A%players%%N/%A%maxplayers%",
						"&8Waiting..."
					),
					STARTING => array(
						"%H[BlockHunt%H]",
						"%A%arenaname%",
						"%A%players%%N/%A%maxplayers%",
						"&2Start: %A%timeleft%"
					),
					INGAME => array(
						"%H[BlockHunt%H]",
						"%A%arenaname%",
						"%A%players%%N/%A%maxplayers%",
						"%EIngame: %A%timeleft"
					)
			));
        } elseif(!$this->getConfig()->exists("scoreboard")){
            $this->getConfig()->set("scoreboard",  array(
					enabled => true, 
					title => "%H[BlockHunt]",
					timeleft => "%ATime left:",
					seekers => "%NSeekers:",
					hiders => "%NHiders:",
					vaultBank => "%NBank:",
					tokenAmount => "%NTokens:"
			));
        } elseif(!$this->getConfig()->exists("requireInventoryClearOnJoin")){
            $this->getConfig()->set("requireInventoryClearOnJoin",  false);
        }

        $this->getConfig()->save();
        return true;
    }
}
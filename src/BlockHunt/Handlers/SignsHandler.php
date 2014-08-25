<?php
namespace BlockHunt\Handlers;

use pocketmine\plugin\Plugin;
use pocketmine\level\Position;
use pocketmine\event\Listener;
use pocketmine\event\block\SignChangeEvent;

use BlockHunt\BlockHunt;
use BlockHunt\Entities\Arena;
use BlockHunt\PlayerArenaData;

class SignsHandler
{
	private $plugin;

	public function __construct(BlockHunt $plugin){
		$this->plugin = $plugin;
	}
	
   public static function createSign(SignChangeEvent $event, $lines, $location)
   {
     if ($lines[1] != null) {
       if (strtolower($lines[1]) == "leave")
       {
         $saved = false;
         $number = 1;
         while (!$saved) {
           if ($this->plugin->storage->signs->get("leave_" . $number) == null)
           {
				$this->plugin->storage->signs->set("leave_" . $number . ".arenaName", "leave");
				$this->plugin->storage->signs->set("leave_" . $number . ".location", $location);
				$this->plugin->storage->signs->save();
			 
             $saved = true;
           }
           else
           {
             $number++;
           }
         }
       }
       else if (strtolower($lines[1]) == "shop")
       {
         $saved = false;
         $number = 1;
         while (!$saved) {
           if ($this->plugin->storage->signs->get("shop_" . $number) == null)
           {
             $this->plugin->storage->signs->set("shop_" . $number . ".arenaName", 
               "shop");
             $this->plugin->storage->signs->set("shop_" . $number . ".location", 
               location);
             $this->plugin->storage->signs->save();
             
             $saved = true;
           }
           else
           {
             $number++;
           }
         }
       }
       else
       {
         $saved = false;
         foreach($this->plugin->storage->arenaList as $arena) {
           if ($lines[1] == $arena->arenaName)
           {
             $number = 1;
             while (!$saved) {
               if ($this->plugin->storage->signs->get(
                 $arena->arenaName . "_" . $number) == null)
               {
                 $this->plugin->storage->signs->set($arena->arenaName . "_" . $number . ".arenaName", $lines[1]);
                 $this->plugin->storage->signs->set($$arena->arenaName . "_" . $number .".location", $location);
                 $this->plugin->storage->signs->save();
                 
                 $saved = true;
               }
               else
               {
                 $number++;
               }
             }
           }
         }
         if (!$saved) {
           MessageM::sendFMessage($sender, $this->plugin->storage->message->get("error")["noArena"], "name-" . $lines[1] );
         }
       }
     }
   }
   
   public static function removeSign(Position $position)
   {
     foreach($this->plugin->storage->signs->getAll() as $sign)
     {
		$signloc = $this->plugin->storage->signs->get($sign.".location");
		$locx = new Position($signloc->getX() - 0.5, $signloc->getY(), $signloc->getZ() - 0.5, $signloc->getLevel());
		if ($locx === $position)
		{
			$this->plugin->storage->signs->set($sign, null);
		}
     }
   }
   
   public static function isSign(Position $position)
   {
     foreach($this->plugin->storage->signs->getAll() as $sign)
     {
       $signloc = $this->plugin->storage->signs->get($sign.".location");
		$locx = new Position($signloc->getX() - 0.5, $signloc->getY(), $signloc->getZ() - 0.5, $signloc->getLevel());
       if ($locx == $position) {
         return true;
       }
     }
     return false;
   }
   
   public function updateSigns()
   {
	$this->plugin->storage->signs->reload();
     foreach($this->plugin->storage->signs->getAll() as $sign)
     {
       $signloc = $this->plugin->storage->signs->get($sign.".location");
		$locx = new Position($signloc->getX() - 0.5, $signloc->getY(), $signloc->getZ() - 0.5, $signloc->getLevel());
       if (($locx->getBlock()->getID() == Item::SIGN_POST) || ($loc->getBlock()->getID() == Item::WALL_SIGN))
       {
         $signblock = $locx->getBlock();
         $lines = $signblock->getLines();
         if (strpos($sign, "leave"))
         {
           $signLines = $this->plugin->config->get('sign')['LEAVE'];
           $linecount = 0;
           foreach($signLines as $line)
           {
             if ($linecount <= 3) {
               $signblock->setLine($linecount, MessageM::replaceAll($line));
             }
             $linecount++;
           }
           $signblock->update();
         }
         else
         {
           $linecount;
           if (strpos($sign, "shop"))
           {
			$signLines = $this->plugin->config->get('sign')['SHOP'];
			$linecount = 0;
			foreach($signLines as $line)
			{
				if ($linecount <= 3) {
					$signblock->setLine($linecount, MessageM::replaceAll($line));
				}
				$linecount++;
			}
			$signblock->update();
           }
           else
           {
             foreach($this->plugin->storage->arenaList as $arena) {
               if (substr($lines[1], -strlen($arena->arenaName)) === $arena->arenaName) {
                 if ($arena::gameState == ArenaState::WAITING)
                 {
                  $signLines = $this->plugin->config->get('sign')['WAITING'];
                   $linecount = 0;
                   if ($signLines != null) {
                     foreach($signLines as $line)
                     {
                       if ($linecount <= 3) {
                         $signblock->setLine($linecount, MessageM::replaceAll( $line, ["arenaname-" . $arena->arenaName, "players-" . count($arena->playersInArena),  "maxplayers-" . $arena->maxPlayers, "timeleft-" . $arena->timer]));
                       }
                       $linecount++;
                     }
                   }
                   $signblock->update();
                 }
                 else if ($arena::gameState == ArenaState::STARTING)
                 {
                   $signLines = $this->plugin->config->get('sign')['STARTING'];
				   $linecount = 0;
                   if ($signLines != null) {
                     foreach($signLines as $line)
                     {
                       if (linecount <= 3) {
							 $signblock->setLine($linecount, MessageM::replaceAll($line, ["arenaname-" . $arena->arenaName, "players-" . count($arena->playersInArena), "maxplayers-".$arena->maxPlayers, "timeleft-" . $arena->timer ]));
                       }
                       $linecount++;
                     }
                   }
                   $signblock->update();
                 }
                 else if ($arena::gameState == ArenaState::INGAME)
                 {
                   $signLines = $this->plugin->config->get('sign')['INGAME'];
                   $linecount = 0;
                   if ($signLines != null) {
                     foreach($signLines as $line)
                     {
                       if ($linecount <= 3) {
                         $signblock->setLine($linecount, MessageM::replaceAll($line, [ "arenaname-" . $arena->arenaName, "players-".count($arena->playersInArena), "maxplayers-" . $arena->maxPlayers, "timeleft-" . $arena->timer ]));
                       }
                       $linecount++;
                     }
                   }
                   $signblock->update();
                 }
               }
             }
           }
         }
       }
       else
       {
         removeSign($loc);
       }
     }
   }
}

?>
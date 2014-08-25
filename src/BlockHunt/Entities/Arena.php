<?php
namespace BlockHunt\Entities;

use pocketmine\utils\Config;
use BlockHunt\BlockHunt;
use BlockHunt\Entities\ArenaState;

class Arena
{
   private $plugin;
   public $arenaName;
   public $pos1;
   public $pos2;
   public $maxPlayers;
   public $minPlayers;
   public $amountSeekersOnStart;
   public $timeInLobbyUntilStart;
   public $waitingTimeSeeker;
   public $gameTime;
   public $timeUntilHidersSword;
   public $disguiseBlocks;
   public $lobbyWarp;
   public $hidersWarp;
   public $seekersWarp;
   public $spawnWarp;
   public $seekersWinCommands;
   public $hidersWinCommands;
   public $allowedCommands;
   public $seekersTokenWin;
   public $hidersTokenWin;
   public $killTokens;
   public $playersInArena;
   public $gameState = ArenaState::DISABLED;
   public $timer;
   public $seekers;
   
   public function __construct(BlockHunt $plugin, $arenaName, $pos1, $pos2, $maxPlayers = 1, $minPlayers = 1, $amountSeekersOnStart = 1, $timeInLobbyUntilStart = 300, $waitingTimeSeeker = 20, $gameTime = 360, $timeUntilHidersSword = 30, $disguiseBlocks, $lobbyWarp, $hidersWarp, $seekersWarp, $spawnWarp, $seekersWinCommands, $hidersWinCommands, $allowedCommands, $seekersTokenWin = 50, $hidersTokenWin = 50, $killTokens = 8, $playersInArena, ArenaState $gameState, $timer, $seekers)
   {
		$this->plugin = $plugin;
		$this->arenaName = $arenaName;
		$this->pos1 = $pos1;
		$this->pos2 = $pos2;
		$this->maxPlayers = $maxPlayers;
		$this->minPlayers = $minPlayers;
		$this->amountSeekersOnStart = $amountSeekersOnStart;
		$this->timeInLobbyUntilStart = $timeInLobbyUntilStart;
		$this->waitingTimeSeeker = $waitingTimeSeeker;
		$this->gameTime = $gameTime;
		$this->timeUntilHidersSword = $timeUntilHidersSword;
		$this->disguiseBlocks = $disguiseBlocks;
		$this->lobbyWarp = $lobbyWarp;
		$this->hidersWarp = $hidersWarp;
		$this->seekersWarp = $seekersWarp;
		$this->spawnWarp = $spawnWarp;
		$this->seekersWinCommands = $seekersWinCommands;
		$this->hidersWinCommands = $hidersWinCommands;
		$this->allowedCommands = $allowedCommands;
		$this->seekersTokenWin = $seekersTokenWin;
		$this->hidersTokenWin = $hidersTokenWin;
		$this->killTokens = $killTokens;

		$this->playersInArena = $playersInArena;
		$this->gameState = $gameState;
		$this->timer = $timer;
		$this->seekers = $seekers;
   }
   
   public function serialize()
   {
     $map = array();
     $map["arenaName"] = $this->arenaName;
     $map["pos1"] = $this->pos1;
     $map["pos2"] = $this->pos2;
     $map["maxPlayers"] = $this->maxPlayers;
     $map["minPlayers"] = $this->minPlayers;
     $map["amountSeekersOnStart"] = $this->amountSeekersOnStart;
     $map["timeInLobbyUntilStart"] = $this->timeInLobbyUntilStart;
     $map["waitingTimeSeeker"] = $this->waitingTimeSeeker;
     $map["gameTime"] = $this->gameTime;
     $map["timeUntilHidersSword"] = $this->timeUntilHidersSword;
     $map["disguiseBlocks"] = $this->disguiseBlocks;
     $map["lobbyWarp"] = $this->lobbyWarp;
     $map["hidersWarp"] = $this->hidersWarp;
     $map["seekersWarp"] = $this->seekersWarp;
     $map["spawnWarp"] = $this->spawnWarp;
     $map["seekersWinCommands"] = $this->seekersWinCommands;
     $map["hidersWinCommands"] = $this->hidersWinCommands;
     $map["allowedCommands"] = $this->allowedCommands;
     $map["seekersTokenWin"] = $this->seekersTokenWin;
     $map["hidersTokenWin"] = $this->hidersTokenWin;
     $map["killTokens"] = $this->killTokens;
     return $map;
   }
   
   public static function deserialize($map)
   {
		return new Arena(
		$map["arenaName"],
		$map["pos1"],
		$map["pos2"],
		$map["maxPlayers"],
		$map["minPlayers"],
		$map["amountSeekersOnStart"],
		$map["timeInLobbyUntilStart"],
		$map["waitingTimeSeeker"],
		$map["gameTime"],
		$map["timeUntilHidersSword"],
		$map["disguiseBlocks"],
		$map["lobbyWarp"],
		$map["hidersWarp"],
		$map["seekersWarp"],
		$map["spawnWarp"],
		$map["seekersWinCommands"],
		$map["hidersWinCommands"],
		$map["allowedCommands"],
		$map["seekersTokenWin"],
		$map["hidersTokenWin"],
		$map["killTokens"];
   }
}

?>
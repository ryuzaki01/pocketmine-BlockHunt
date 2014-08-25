<?php

namespace BlockHunt;
 
use pocketmine\plugin\Plugin;
use BlockHunt\Managers\ConfigM;
use BlockHunt\Entities\Enum;
 
class ConfigC extends Enum
{	
	const $chat_tag = array("[BlockHunt] ", "config");
	const $chat_normal = array("&b", "config"); 
	const $chat_warning = array("&c", "config");
	const $chat_error = array("&c", "config");
	const $chat_arg = array("&e", "config");
	const $chat_header = array("&9", "config");
	const $chat_headerhigh = array("%H_______.[ %A%header%%H ]._______", "config");
	const $commandEnabled_info = array(true, "config");
	const $commandEnabled_help = array(true, "config");
	const $commandEnabled_reload = array(true, "config");
	const $commandEnabled_join = array(true, "config");
	const $commandEnabled_leave = array(true, "config");
	const $commandEnabled_list = array(true, "config");
	const $commandEnabled_shop = array(true, "config");
	const $commandEnabled_start = array(true, "config");
	const $commandEnabled_wand = array(true, "config");
	const $commandEnabled_create = array(true, "config");
	const $commandEnabled_set = array(true, "config");
	const $commandEnabled_setwarp = array(true, "config");
	const $commandEnabled_remove = array(true, "config");
	const $commandEnabled_tokens = array(true, "config");
	const $autoUpdateCheck = array(true, "config");
	const $autoDownloadUpdate = array(false, "config");
	const $vaultSupport = array(false, "config");
	const $wandIDname = array("STICK", "config");
	const $wandName = array("%A&lBlockHunt%N's selection wand", "config");
	const $wandDescription = array(["%NUse this item to select an arena for your arena.", "%ALeft-Click%N to select point #1.", "%ARight-Click%N to select point #2.", "%NUse the create command to define your arena.", "%A/BlockHunt <help|h>" ], "config");
	const $shop_title = array("%H&lBlockHunt %NShop", "config");
	const $shop_price = array("%NPrice: %A%amount% %Ntokens.", "config");
	const $shop_blockChooserv1Enabled = array(true, "config");
	const $shop_blockChooserv1IDname = array("BOOK", "config");
	const $shop_blockChooserv1Price = array(3000, "config");
	const $shop_blockChooserv1Name = array("%H&lBlock Chooser", "config");
	const $shop_blockChooserv1Description = array(["%NUse this item before the arena starts.", "%ARight-Click%N in the lobby and choose", "%Nthe block you want to be!", "&6Unlimited uses." ], "config");
	const $shop_BlockHuntPassv2Enabled = array(true, "config");
	const $shop_BlockHuntPassv2IDName = array("NAME_TAG", "config");
	const $shop_BlockHuntPassv2Price = array(150, "config");
	const $shop_BlockHuntPassv2Name = array("%H&lBlockHunt Pass", "config");
	const $shop_BlockHuntPassv2Description = array(["%NUse this item before the arena starts.", "%ARight-Click%N in the lobby and choose", "%Nif you want to be a Hider or a Seeker!", "&61 time use." ], "config");
	const $sign_LEAVE = array([ "%H[BlockHunt%H]", "&4LEAVE", "&8Right-Click", "&8To leave." ], "config");
	const $sign_SHOP = array([ "%H[BlockHunt%H]", "&4SHOP", "&8Right-Click", "&8To shop." ], "config");
	const $sign_WAITING = array([ "%H[BlockHunt%H]", "%A%arenaname%", "%A%players%%N/%A%maxplayers%", "&8Waiting..." ], "config");
	const $sign_STARTING = array([ "%H[BlockHunt%H]", "%A%arenaname%", "%A%players%%N/%A%maxplayers%", "&2Start: %A%timeleft%" ], "config");
	const $sign_INGAME = array([ "%H[BlockHunt%H]", "%A%arenaname%", "%A%players%%N/%A%maxplayers%", "%EIngame: %A%timeleft%" ], "config");
	const $scoreboard_enabled = array(true, "config");
	const $scoreboard_title = array("%H[BlockHunt]", "config");
	const $scoreboard_timeleft = array("%ATime left:", "config");
	const $scoreboard_seekers = array("%NSeekers:", "config");
	const $scoreboard_hiders = array("%NHiders:", "config");
	const $scoreboard_vaultBank = array("%NBank:", "config");
	const $scoreboard_tokenAmount = array("%NTokens:", "config");
	const $requireInventoryClearOnJoin = array(false, "config");
	const $log_enabledPlugin = array("%TAG%N%name%&a&k + %N%version% is now Enabled. Made by %A%autors%%N.", "messages");
	const $log_disabledPlugin = array("%TAG%N%name%&c&k - %N%version% is now Disabled. Made by %A%autors%%N.", "messages");
	const $help_info = array("%NDisplays the plugin's info.", "messages");
	const $help_help = array("%NShows a list of commands.", "messages");
	const $help_reload = array("%NReloads all configs.", "messages");
	const $help_join = array("%NJoins a BlockHunt game.", "messages");
	const $help_leave = array("%NLeave a BlockHunt game.", "messages");
	const $help_list = array("%NShows a list of available arenas.", "messages");
	const $help_shop = array("%NOpens the BlockHunt shop.", "messages");
	const $help_start = array("%NForces an arena to start.", "messages");
	const $help_wand = array("%NGives you the wand selection tool.", "messages");
	const $help_create = array("%NCreates an arena from your selection.", "messages");
	const $help_set = array("%NOpens a panel to set settings.", "messages");
	const $help_setwarp = array("%NSets warps for your arena.", "messages");
	const $help_remove = array("%NDeletes an Arena.", "messages");
	const $help_tokens = array("%NChange someones tokens.", "messages");
	const $button_add = array("%NAdd %A%1%%N to %A%2%%N", "messages");
	const $button_add2 = array("Add", "messages");
	const $button_setting = array("%NSetting %A%1%%N is now: %A%2%%N.", "messages");
	const $button_remove = array("%NRemove %A%1%%N from %A%2%%N", "messages");
	const $button_remove2 = array("Remove", "messages");
	const $normal_reloadedConfigs = array("%TAG&aReloaded all configs!", "messages");
	const $normal_joinJoinedArena = array("%TAG%A%playername%%N joined your arena. (%A%1%%N/%A%2%%N)", "messages");
	const $normal_leaveYouLeft = array("%TAG%NYou left the arena! Thanks for playing !", "messages");
	const $normal_leaveLeftArena = array("%TAG%A%playername%%N left your arena. (%A%1%%N/%A%2%%N)", "messages");
	const $normal_startForced = array("%TAG%NYou forced to start arena '%A%arenaname%%N'!", "messages");
	const $normal_wandGaveWand = array("%TAG%NHere you go! &o(Use the %A&o%type%%N&o!)", "messages");
	const $normal_wandSetPosition = array("%TAG%NSet position %A#%number%%N to location: (%A%x%%N, %A%y%%N, %A%z%%N).", "messages");
	const $normal_createCreatedArena = array("%TAG%NCreated an arena with the name '%A%name%%N'.", "messages");
	const $normal_lobbyArenaIsStarting = array("%TAG%NThe arena will start in %A%1%%N second(s)!", "messages");
	const $normal_lobbyArenaStarted = array("%TAG%NThe arena has been started! The seeker is coming to find you in %A%secs%%N seconds!", "messages");
	const $normal_ingameSeekerChoosen = array("%TAG%NPlayer %A%seeker%%N has been choosen as seeker!", "messages");
	const $normal_ingameBlock = array("%TAG%NYou're disguised as a(n) '%A%block%%N' block.", "messages");
	const $normal_ingameArenaEnd = array("%TAG%NThe arena will end in %A%1%%N second(s)!", "messages");
	const $normal_ingameSeekerSpawned = array("%TAG%A%playername%%N has spawned as a seeker!", "messages");
	const $normal_ingameGivenSword = array("%TAG%NYou were given a sword!", "messages");
	const $normal_ingameHiderDied = array("%TAG%NHider %A%playername%%N died! %A%left%%N hider(s); remain...", "messages");
	const $normal_ingameSeekerDied = array("%TAG%NSeeker %A%playername%%N died! He will respawn in %A%secs%%N seconds!", "messages");
	const $normal_winSeekers = array("%TAG%NThe %ASEEKERS%N have won!", "messages");
	const $normal_winHiders = array("%TAG%NThe %AHIDERS%N have won!", "messages");
	const $normal_setwarpWarpSet = array("%TAG%NSet warp '%A%warp%%N' to your location!", "messages");
	const $normal_addedToken = array("%TAG%A%amount%%N tokens were added to your account!", "messages");
	const $normal_addedVaultBalance = array("%TAG%A%amount%%N was added to your bank!", "messages");
	const $normal_addedVaultBalanceKill = array("%TAG%A%amount%%N has been added for killing a hider", "messages");
	const $normal_removeRemovedArena = array("%TAG%NRemoved arena '%A%name%%N'!", "messages");
	const $normal_tokensChanged = array("%TAG%N%option% %A%amount%%N tokens %option2% %A%playername%%N.", "messages");
	const $normal_tokensChangedPerson = array("%TAG%NPlayer %A%playername%%N %N%option% %A%amount%%N %option2% your tokens.", "messages");
	const $normal_ingameNowSolid = array("%TAG%NYou're now a solid '%A%block%%N' block!", "messages");
	const $normal_ingameNoMoreSolid = array("%TAG%NYou're no longer a solid block!", "messages");
	const $normal_shopBoughtItem = array("%TAG%NYou've bought the '%A%itemname%%N' item!", "messages");
	const $normal_shopChoosenBlock = array("%TAG%NYou've choosen to be a(n) '%A%block%%N' block!", "messages");
	const $normal_shopChoosenSeeker = array("%TAG%NYou've choosen to be a %Aseeker%N!", "messages");
	const $normal_shopChoosenHiders = array("%TAG%NYou've choosen to be a %Ahider%N!", "messages");
	const $warning_lobbyNeedAtleast = array("%TAG%WYou need atleast %A%1%%W player(s) to start the game!", "messages");
	const $warning_ingameNEWSeekerChoosen = array("%TAG%WThe last seeker left and a new seeker has been choosen!", "messages");
	const $warning_unableToCommand = array("%TAG%WSorry but that command is disabled in the arena.", "messages");
	const $warning_ingameNoSolidPlace = array("%TAG%WThat's not a valid place to become solid!", "messages");
	const $warning_arenaStopped = array("%TAG%WThe arena has been forced to stop!", "messages");
	const $warning_noVault = array("%TAG%WUsing BlockHunts token system!", "messages");
	const $warning_usingVault = array("%TAG%WUsing Vault support", "messages");
	const $error_noPermission = array("%TAG%EYou don't have the permissions to do that!", "messages");
	const $error_notANumber = array("%TAG%E'%A%1%%E' is not a number!", "messages");
	const $error_commandNotEnabled = array("%TAG%EThis command has been disabled!", "messages");
	const $error_commandNotFound = array("%TAG%ECouldn't find the command. Try %A/BlockHunt help %Efor more info.", "messages");
	const $error_notEnoughArguments = array("%TAG%EYou're missing arguments, correct syntax: %A%syntax%", "messages");
	const $error_libsDisguisesNotInstalled = array("%TAG%EThe plugin '%ALib's Disguises%E' is required to run this plugin! Intall it or it won't work!", "messages");
	const $error_protocolLibNotInstalled = array("%TAG%EThe plugin '%AProtocolLib%E' is required to run this plugin! Intall it or it won't work!", "messages");
	const $error_noArena = array("%TAG%ENo arena found with the name '%A%name%%E'.", "messages");
	const $error_onlyIngame = array("%TAG%EThis is an only in-game command!", "messages");
	const $error_joinAlreadyJoined = array("%TAG%EYou've already joined an arena!", "messages");
	const $error_joinNoBlocksSet = array("%TAG%EThere are none blocks set for this arena. Notify the administrator.", "messages");
	const $error_joinWarpsNotSet = array("%TAG%EThere are no warps set for this arena. Notify the administrator.", "messages");
	const $error_joinArenaIngame = array("%TAG%EThis game has already started.", "messages");
	const $error_joinFull = array("%TAG%EUnable to join this arena. It's full!", "messages");
	const $error_joinInventoryNotEmpty = array("%TAG%EYour inventory should be empty before joining!", "messages");
	const $error_leaveNotInArena = array("%TAG%EYou're not in an arena!", "messages");
	const $error_createSelectionFirst = array("%TAG%EMake a selection first. Use the wand command: %A/BlockHunt <wand|w>%E.", "messages");
	const $error_createNotSameWorld = array("%TAG%EMake your selection points in the same world!", "messages");
	const $error_setTooHighNumber = array("%TAG%EThat amount is too high! Max amount is: %A%max%%E.", "messages");
	const $error_setTooLowNumber = array("%TAG%EThat amount is too low! Minimal amount is: %A%min%%E.", "messages");
	const $error_setNotABlock = array("%TAG%EThat is not a block!", "messages");
	const $error_setwarpWarpNotFound = array("%TAG%EWarp '%A%warp%%E' is not valid!", "messages");
	const $error_tokensPlayerNotOnline = array("%TAG%ENo player found with the name '%A%playername%%E'!", "messages");
	const $error_tokensUnknownsetting = array("%TAG%E'%A%option%%E' is not a known option!", "messages");
	const $error_shopNeedMoreTokens = array("%TAG%EYou need more tokens before you can buy this item.", "messages");
	const $error_shopMaxSeekersReached = array("%TAG%ESorry, the maximum amount of seekers has been reached!", "messages");
	const $error_shopMaxHidersReached = array("%TAG%ESorry, the maximum amount of hiders has been reached!", "messages");
	const $error_trueVaultNull = array("%TAG%EVault has been enabled in the config.yml but cannot find the 'Vault' plugin! The plugin will not run", "messages");

	private $plugin;
	public $value;
	public $config;
	public $location;
	
	public function __construct(Plugin $plugin, $value){
		$this->plugin = $plugin;
		$this->config = new ConfigM($plugin, $this->${$value}[0]);
		$this->value = $value;
		$this->location = str_replace("_", "->", $value);
	}
	
	public function values(){
		$enums = new ReflectionClass($this);
		return $enums->getConstants();
	}
}




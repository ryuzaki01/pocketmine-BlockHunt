<?php

namespace BlockHunt;
 
use pocketmine\plugin\Plugin;
use BlockHunt\Managers\ConfigM;
 
class ConfigC
{	
	private $plugin;
	private $cfg = false;
	
	public $chat_tag = array("[BlockHunt] ", "config");
	public $chat_normal = array("&b", "config"); 
	public $chat_warning = array("&c", "config");
	public $chat_error = array("&c", "config");
	public $chat_arg = array("&e", "config");
	public $chat_header = array("&9", "config");
	public $chat_headerhigh = array("%H_______.[ %A%header%%H ]._______", "config");
	public $commandEnabled_info = array(true, "config");
	public $commandEnabled_help = array(true, "config");
	public $commandEnabled_reload = array(true, "config");
	public $commandEnabled_join = array(true, "config");
	public $commandEnabled_leave = array(true, "config");
	public $commandEnabled_list = array(true, "config");
	public $commandEnabled_shop = array(true, "config");
	public $commandEnabled_start = array(true, "config");
	public $commandEnabled_wand = array(true, "config");
	public $commandEnabled_create = array(true, "config");
	public $commandEnabled_set = array(true, "config");
	public $commandEnabled_setwarp = array(true, "config");
	public $commandEnabled_remove = array(true, "config");
	public $commandEnabled_tokens = array(true, "config");
	public $autoUpdateCheck = array(true, "config");
	public $autoDownloadUpdate = array(false, "config");
	public $vaultSupport = array(false, "config");
	public $wandIDname = array("STICK", "config");
	public $wandName = array("%A&lBlockHunt%N's selection wand", "config");
	public $wandDescription = array(["%NUse this item to select an arena for your arena.", "%ALeft-Click%N to select point #1.", "%ARight-Click%N to select point #2.", "%NUse the create command to define your arena.", "%A/BlockHunt <help|h>" ], "config");
	public $shop_title = array("%H&lBlockHunt %NShop", "config");
	public $shop_price = array("%NPrice: %A%amount% %Ntokens.", "config");
	public $shop_blockChooserv1Enabled = array(true, "config");
	public $shop_blockChooserv1IDname = array("BOOK", "config");
	public $shop_blockChooserv1Price = array(3000, "config");
	public $shop_blockChooserv1Name = array("%H&lBlock Chooser", "config");
	public $shop_blockChooserv1Description = array(["%NUse this item before the arena starts.", "%ARight-Click%N in the lobby and choose", "%Nthe block you want to be!", "&6Unlimited uses." ], "config");
	public $shop_BlockHuntPassv2Enabled = array(true, "config");
	public $shop_BlockHuntPassv2IDName = array("NAME_TAG", "config");
	public $shop_BlockHuntPassv2Price = array(150, "config");
	public $shop_BlockHuntPassv2Name = array("%H&lBlockHunt Pass", "config");
	public $shop_BlockHuntPassv2Description = array(["%NUse this item before the arena starts.", "%ARight-Click%N in the lobby and choose", "%Nif you want to be a Hider or a Seeker!", "&61 time use." ], "config");
	public $sign_LEAVE = array([ "%H[BlockHunt%H]", "&4LEAVE", "&8Right-Click", "&8To leave." ], "config");
	public $sign_SHOP = array([ "%H[BlockHunt%H]", "&4SHOP", "&8Right-Click", "&8To shop." ], "config");
	public $sign_WAITING = array([ "%H[BlockHunt%H]", "%A%arenaname%", "%A%players%%N/%A%maxplayers%", "&8Waiting..." ], "config");
	public $sign_STARTING = array([ "%H[BlockHunt%H]", "%A%arenaname%", "%A%players%%N/%A%maxplayers%", "&2Start: %A%timeleft%" ], "config");
	public $sign_INGAME = array([ "%H[BlockHunt%H]", "%A%arenaname%", "%A%players%%N/%A%maxplayers%", "%EIngame: %A%timeleft%" ], "config");
	public $scoreboard_enabled = array(true, "config");
	public $scoreboard_title = array("%H[BlockHunt]", "config");
	public $scoreboard_timeleft = array("%ATime left:", "config");
	public $scoreboard_seekers = array("%NSeekers:", "config");
	public $scoreboard_hiders = array("%NHiders:", "config");
	public $scoreboard_vaultBank = array("%NBank:", "config");
	public $scoreboard_tokenAmount = array("%NTokens:", "config");
	public $requireInventoryClearOnJoin = array(false, "config");
	public $log_enabledPlugin = array("%TAG%N%name%&a&k + %N%version% is now Enabled. Made by %A%autors%%N.", "messages");
	public $log_disabledPlugin = array("%TAG%N%name%&c&k - %N%version% is now Disabled. Made by %A%autors%%N.", "messages");
	public $help_info = array("%NDisplays the plugin's info.", "messages");
	public $help_help = array("%NShows a list of commands.", "messages");
	public $help_reload = array("%NReloads all configs.", "messages");
	public $help_join = array("%NJoins a BlockHunt game.", "messages");
	public $help_leave = array("%NLeave a BlockHunt game.", "messages");
	public $help_list = array("%NShows a list of available arenas.", "messages");
	public $help_shop = array("%NOpens the BlockHunt shop.", "messages");
	public $help_start = array("%NForces an arena to start.", "messages");
	public $help_wand = array("%NGives you the wand selection tool.", "messages");
	public $help_create = array("%NCreates an arena from your selection.", "messages");
	public $help_set = array("%NOpens a panel to set settings.", "messages");
	public $help_setwarp = array("%NSets warps for your arena.", "messages");
	public $help_remove = array("%NDeletes an Arena.", "messages");
	public $help_tokens = array("%NChange someones tokens.", "messages");
	public $button_add = array("%NAdd %A%1%%N to %A%2%%N", "messages");
	public $button_add2 = array("Add", "messages");
	public $button_setting = array("%NSetting %A%1%%N is now: %A%2%%N.", "messages");
	public $button_remove = array("%NRemove %A%1%%N from %A%2%%N", "messages");
	public $button_remove2 = array("Remove", "messages");
	public $normal_reloadedConfigs = array("%TAG&aReloaded all configs!", "messages");
	public $normal_joinJoinedArena = array("%TAG%A%playername%%N joined your arena. (%A%1%%N/%A%2%%N)", "messages");
	public $normal_leaveYouLeft = array("%TAG%NYou left the arena! Thanks for playing !", "messages");
	public $normal_leaveLeftArena = array("%TAG%A%playername%%N left your arena. (%A%1%%N/%A%2%%N)", "messages");
	public $normal_startForced = array("%TAG%NYou forced to start arena '%A%arenaname%%N'!", "messages");
	public $normal_wandGaveWand = array("%TAG%NHere you go! &o(Use the %A&o%type%%N&o!)", "messages");
	public $normal_wandSetPosition = array("%TAG%NSet position %A#%number%%N to location: (%A%x%%N, %A%y%%N, %A%z%%N).", "messages");
	public $normal_createCreatedArena = array("%TAG%NCreated an arena with the name '%A%name%%N'.", "messages");
	public $normal_lobbyArenaIsStarting = array("%TAG%NThe arena will start in %A%1%%N second(s)!", "messages");
	public $normal_lobbyArenaStarted = array("%TAG%NThe arena has been started! The seeker is coming to find you in %A%secs%%N seconds!", "messages");
	public $normal_ingameSeekerChoosen = array("%TAG%NPlayer %A%seeker%%N has been choosen as seeker!", "messages");
	public $normal_ingameBlock = array("%TAG%NYou're disguised as a(n) '%A%block%%N' block.", "messages");
	public $normal_ingameArenaEnd = array("%TAG%NThe arena will end in %A%1%%N second(s)!", "messages");
	public $normal_ingameSeekerSpawned = array("%TAG%A%playername%%N has spawned as a seeker!", "messages");
	public $normal_ingameGivenSword = array("%TAG%NYou were given a sword!", "messages");
	public $normal_ingameHiderDied = array("%TAG%NHider %A%playername%%N died! %A%left%%N hider(s); remain...", "messages");
	public $normal_ingameSeekerDied = array("%TAG%NSeeker %A%playername%%N died! He will respawn in %A%secs%%N seconds!", "messages");
	public $normal_winSeekers = array("%TAG%NThe %ASEEKERS%N have won!", "messages");
	public $normal_winHiders = array("%TAG%NThe %AHIDERS%N have won!", "messages");
	public $normal_setwarpWarpSet = array("%TAG%NSet warp '%A%warp%%N' to your location!", "messages");
	public $normal_addedToken = array("%TAG%A%amount%%N tokens were added to your account!", "messages");
	public $normal_addedVaultBalance = array("%TAG%A%amount%%N was added to your bank!", "messages");
	public $normal_addedVaultBalanceKill = array("%TAG%A%amount%%N has been added for killing a hider", "messages");
	public $normal_removeRemovedArena = array("%TAG%NRemoved arena '%A%name%%N'!", "messages");
	public $normal_tokensChanged = array("%TAG%N%option% %A%amount%%N tokens %option2% %A%playername%%N.", "messages");
	public $normal_tokensChangedPerson = array("%TAG%NPlayer %A%playername%%N %N%option% %A%amount%%N %option2% your tokens.", "messages");
	public $normal_ingameNowSolid = array("%TAG%NYou're now a solid '%A%block%%N' block!", "messages");
	public $normal_ingameNoMoreSolid = array("%TAG%NYou're no longer a solid block!", "messages");
	public $normal_shopBoughtItem = array("%TAG%NYou've bought the '%A%itemname%%N' item!", "messages");
	public $normal_shopChoosenBlock = array("%TAG%NYou've choosen to be a(n) '%A%block%%N' block!", "messages");
	public $normal_shopChoosenSeeker = array("%TAG%NYou've choosen to be a %Aseeker%N!", "messages");
	public $normal_shopChoosenHiders = array("%TAG%NYou've choosen to be a %Ahider%N!", "messages");
	public $warning_lobbyNeedAtleast = array("%TAG%WYou need atleast %A%1%%W player(s) to start the game!", "messages");
	public $warning_ingameNEWSeekerChoosen = array("%TAG%WThe last seeker left and a new seeker has been choosen!", "messages");
	public $warning_unableToCommand = array("%TAG%WSorry but that command is disabled in the arena.", "messages");
	public $warning_ingameNoSolidPlace = array("%TAG%WThat's not a valid place to become solid!", "messages");
	public $warning_arenaStopped = array("%TAG%WThe arena has been forced to stop!", "messages");
	public $warning_noVault = array("%TAG%WUsing BlockHunts token system!", "messages");
	public $warning_usingVault = array("%TAG%WUsing Vault support", "messages");
	public $error_noPermission = array("%TAG%EYou don't have the permissions to do that!", "messages");
	public $error_notANumber = array("%TAG%E'%A%1%%E' is not a number!", "messages");
	public $error_commandNotEnabled = array("%TAG%EThis command has been disabled!", "messages");
	public $error_commandNotFound = array("%TAG%ECouldn't find the command. Try %A/BlockHunt help %Efor more info.", "messages");
	public $error_notEnoughArguments = array("%TAG%EYou're missing arguments, correct syntax: %A%syntax%", "messages");
	public $error_libsDisguisesNotInstalled = array("%TAG%EThe plugin '%ALib's Disguises%E' is required to run this plugin! Intall it or it won't work!", "messages");
	public $error_protocolLibNotInstalled = array("%TAG%EThe plugin '%AProtocolLib%E' is required to run this plugin! Intall it or it won't work!", "messages");
	public $error_noArena = array("%TAG%ENo arena found with the name '%A%name%%E'.", "messages");
	public $error_onlyIngame = array("%TAG%EThis is an only in-game command!", "messages");
	public $error_joinAlreadyJoined = array("%TAG%EYou've already joined an arena!", "messages");
	public $error_joinNoBlocksSet = array("%TAG%EThere are none blocks set for this arena. Notify the administrator.", "messages");
	public $error_joinWarpsNotSet = array("%TAG%EThere are no warps set for this arena. Notify the administrator.", "messages");
	public $error_joinArenaIngame = array("%TAG%EThis game has already started.", "messages");
	public $error_joinFull = array("%TAG%EUnable to join this arena. It's full!", "messages");
	public $error_joinInventoryNotEmpty = array("%TAG%EYour inventory should be empty before joining!", "messages");
	public $error_leaveNotInArena = array("%TAG%EYou're not in an arena!", "messages");
	public $error_createSelectionFirst = array("%TAG%EMake a selection first. Use the wand command: %A/BlockHunt <wand|w>%E.", "messages");
	public $error_createNotSameWorld = array("%TAG%EMake your selection points in the same world!", "messages");
	public $error_setTooHighNumber = array("%TAG%EThat amount is too high! Max amount is: %A%max%%E.", "messages");
	public $error_setTooLowNumber = array("%TAG%EThat amount is too low! Minimal amount is: %A%min%%E.", "messages");
	public $error_setNotABlock = array("%TAG%EThat is not a block!", "messages");
	public $error_setwarpWarpNotFound = array("%TAG%EWarp '%A%warp%%E' is not valid!", "messages");
	public $error_tokensPlayerNotOnline = array("%TAG%ENo player found with the name '%A%playername%%E'!", "messages");
	public $error_tokensUnknownsetting = array("%TAG%E'%A%option%%E' is not a known option!", "messages");
	public $error_shopNeedMoreTokens = array("%TAG%EYou need more tokens before you can buy this item.", "messages");
	public $error_shopMaxSeekersReached = array("%TAG%ESorry, the maximum amount of seekers has been reached!", "messages");
	public $error_shopMaxHidersReached = array("%TAG%ESorry, the maximum amount of hiders has been reached!", "messages");
	public $error_trueVaultNull = array("%TAG%EVault has been enabled in the config.yml but cannot find the 'Vault' plugin! The plugin will not run", "messages");

	
	public $value;
	public $location;
	
	public function __construct(Plugin $plugin, $value)
	{
		$this->plugin = $plugin;
		$this->cfg = new ConfigM($plugin, String($this->${$value}[1]));
		$this->value = $value;
		$this->location = str_replace("_", "->", $value);
	}
 }




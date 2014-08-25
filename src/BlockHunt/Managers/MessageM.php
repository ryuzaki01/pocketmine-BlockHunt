<?php
use BlockHunt\BlockHunt;
use BlockHunt\ConfigC;
use BlockHunt\Storage;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
 
class MessageM
{
	public $plugin;

    public function __construct(BlockHunt $plugin){
        $this->plugin = $plugin;
    }
	
   public static function sendMessage(Player $player, $message, $vars)
   {
     if (player == null) {
       $this->getLogger()->info(replaceAll(str_replace("%player%", "Console", $message), $vars));
     } else {
       player.sendMessage(replaceAll(str_replace("%player%", player.getName(), $message), $vars));
     }
   }
   
   public static function sendFMessage(Player $player, ConfigC $location, $vars)
   {
     if ($player == null) {
       Bukkit.getConsoleSender().sendMessage(replaceAll(str_replace("%player%", "Console", $location->config->get($location->location)), vars));
     } else {
       player.sendMessage(replaceAll(
         location.config.getFile().get(location.location).toString()
         .replaceAll("%player%", player.getName()), vars));
     }
   }
   
   public static function broadcastMessage(String message, String... vars)
   {
     for (Player player : Bukkit.getServer().getOnlinePlayers()) {
       player.sendMessage(replaceAll(
         message.replaceAll("%player%", player.getName()), vars));
     }
     Bukkit.getConsoleSender().sendMessage(
       replaceAll(message.replaceAll("%player%", "Console"), 
       vars));
   }
   
   public static function broadcastFMessage(ConfigC location, String... vars)
   {
     for (Player player : Bukkit.getServer().getOnlinePlayers()) {
       player.sendMessage(replaceAll(
         location.config.getFile().get(location.location).toString()
         .replaceAll("%player%", player.getName()), vars));
     }
		$this->plugin->getServer()->dispatchCommand(new ConsoleCommandSender(), replaceAll(location.config.getFile().get(location.location).toString().replaceAll("%player%", "Console"), vars));
   }
   
   public static String replaceAll($message, $vars)
   {
     return replaceColours(replaceColourVars(
       replaceVars(message, vars)));
   }
   
   public static String replaceColours($message)
   {
     return message.replaceAll("(&([a-fk-or0-9]))", "Â§$2");
   }
   
   public static String replaceColourVars($message)
   {
     message = message.replaceAll("%N", CType.NORMAL());
     message = message.replaceAll("%W", CType.WARNING());
     message = message.replaceAll("%E", CType.ERROR());
     message = message.replaceAll("%A", CType.ARG());
     message = message.replaceAll("%H", CType.HEADER());
     message = message.replaceAll("%TAG", CType.TAG());
     return message;
   }
   
   public static String replaceVars(String message, String... vars)
   {
     for (String var : vars)
     {
       String[] split = var.split("-");
       message = message.replaceAll("%" + split[0] + "%", split[1]);
     }
     return message;
   }
   
   public static class CType
   {
     public static String NORMAL()
     {
       return (String)W.config.get(ConfigC.chat_normal);
     }
     
     public static String WARNING()
     {
       return (String)W.config.get(ConfigC.chat_warning);
     }
     
     public static String ERROR()
     {
       return (String)W.config.get(ConfigC.chat_error);
     }
     
     public static String ARG()
     {
       return (String)W.config.get(ConfigC.chat_arg);
     }
     
     public static String HEADER()
     {
       return (String)W.config.get(ConfigC.chat_header);
     }
     
     public static String TAG()
     {
       return 
       
         (String)W.config.get(ConfigC.chat_header) + (String)W.config.get(ConfigC.chat_tag) + (String)W.config.get(ConfigC.chat_normal);
     }
   }
}
?>
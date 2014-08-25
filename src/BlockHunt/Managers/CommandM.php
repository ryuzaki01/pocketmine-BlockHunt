<?php
namespace BlockHunt\Managers;

use BlockHunt\Commands\DefaultCMD;
use BlockHunt\ConfigC;
//use BlockHunt\PermissionsC;
use BlockHunt\BlockHunt;

class CommandM {
	public $plugin;
	public $name; // String
	public $label; // String
	public $args; // String
	public $argsalias; // String
	public $permission; // PermissionsC.Permissions
	public $help; // ConFigC
	public $enabled; // boolean
	public $mainTRBlist; // List<String>
	public $CMD; // DeFaultCMD
	public $usage; // String

	public function __construct(BlockHunt $plugin, $name, $label, $args, $argsalias, $permission, $help, $enabled, $mainTRBlist, $CMD, $usage) // [String name, String label, String args, String argsalias, PermissionsC.Permissions permission, ConFigC
	{
		$me = new self();
		$me->plugin = $plugin;
		$me->name = $name;
		$me->label = $label;
		$me->args = $args;
		$me->argsalias = $argsalias;
		$me->permission = $permission;
		$me->help = $help;
		$me->enabled = $enabled->booleanValue();
		$me->mainTRBlist = $mainTRBlist;
		$me->CMD = $CMD;
		$me->usage = $usage;
		$this->plugin->commands->add($me);
	}
}
?>
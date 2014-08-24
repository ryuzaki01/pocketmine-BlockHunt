<?php
namespace HideHunt\Managers;

use HideHunt\Commands\DefaultCMD;
use HideHunt\ConfigC;
use HideHunt\PermissionsC;
use HideHunt\W;

class CommandM {
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

	private function __init() { // deFault class members
		public static function __staticinit() // static class members
	}

	public static function __construct($name, $label, $args, $argsalias, $permission, $help, $enabled, $mainTRBlist, $CMD, $usage) // [String name, String label, String args, String argsalias, PermissionsC.Permissions permission, ConFigC
	{
		$me = new self();
		$me->__init():
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
		W::$commands->add($me);
		return $me;
	}
}
CommandM::__staticinit(); // initialize static vars For this class on load
?>
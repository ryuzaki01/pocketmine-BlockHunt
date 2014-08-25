<?php
namespace BlockHunt\Entities;

class ArenaType extends SplEnum
{
	const maxPlayers = 0;
	const minPlayers = 1;
	const amountSeekersOnStart = 2;
	const timeInLobbyUntilStart = 3;
	const waitingTimeSeeker = 4;
	const gameTime = 5;
	const timeUntilHidersSword = 6;
	const hidersTokenWin = 7;
	const seekersTokenWin = 8;
	const killTokens = 9;
}
?>
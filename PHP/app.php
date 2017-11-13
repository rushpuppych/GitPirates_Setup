<?php
/*
 *   _________                                __________.__               __
 *  /   _____/ ____  __ _________   ____  ____\______   \__|___________ _/  |_  ____   ______
 *  \_____  \ /  _ \|  |  \_  __ \_/ ___\/ __ \|     ___/  \_  __ \__  \\   __\/ __ \ /  ___/
 *  /        (  <_> )  |  /|  | \/\  \__\  ___/|    |   |  ||  | \// __ \|  | \  ___/ \___ \
 * /_______  /\____/|____/ |__|    \___  >___  >____|   |__||__|  (____  /__|  \___  >____  >
 *         \/                          \/    \/                        \/          \/     \/
 *
 * @author: YOUR NAME (YOUR EMAIL)
 * @datum: 00.00.0000
 * @description: FEATURES
 */
// Config and Initialize CodePirates Script
$strIoFolder = dirname(__FILE__) . "/io";
include_once("lib" . DIRECTORY_SEPARATOR . "SourcePirates.php");
main(new SourcePirates($strIoFolder));


/**
 * Main Routine
 * @param SourcePirates $objGame
 */
function main(SourcePirates $objGame)
{

	// Write your PHP Code here...
	$objGame->log('it is running');

	// Send Orders to the Game
	$objGame->executeOrders();
}

<?php
/*
 * _________            .___    __________.__               __
 * \_   ___ \  ____   __| _/____\______   \__|___________ _/  |_  ____   ______
 * /    \  \/ /  _ \ / __ |/ __ \|     ___/  \_  __ \__  \\   __\/ __ \ /  ___/
 * \     \___(  <_> ) /_/ \  ___/|    |   |  ||  | \// __ \|  | \  ___/ \___ \
 *  \______  /\____/\____ |\___  >____|   |__||__|  (____  /__|  \___  >____  >
 *         \/            \/    \/                        \/          \/     \/
 *
 *
 * @author: YOUR NAME (YOUR EMAIL)
 * @datum: 00.00.0000
 * @description: FEATURES
 */
// Config and Initialize CodePirates Script
$strIoFolder = dirname(__FILE__) . "/io";
include_once("lib" . DIRECTORY_SEPARATOR . "CodePirates.php");
main(new CodePirates($strIoFolder));


/**
 * Main Routine
 * @param CodePirates $objGame
 */
function main(CodePirates $objGame)
{

	// Write your PHP Code here...
	$objGame->log('it is running');

	// Send Orders to the Game
	$objGame->executeOrders();
}

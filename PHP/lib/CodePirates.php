<?php
/**
 * Class CodePirates
 *
 * @author      Severin Holm <info@severin.holm.ch>
 * @version     v.1.1 (06/12/2017)
 * @copyright   Copyright (c) 2017, Severin Holm
 */

/**
 * CodePirates
 * This is a PHP Wrapper for the CodePirate Game
 */
class CodePirates {
	// Private Attributes
	private $numTurn = 0;
	private $arrPlayer = [];
	private $arrPlayers = [];
	private $arrMap = [];
	private $arrSpecial = [];
	private $strIoFolder = '';
	private $arrOutput = [];
	private $arrLocalSession = [];

	/**
	 * Constructor
	 *
	 * @param $strIoFolder	This is the Input/Output File Folder
	 */
	public function __construct($strIoFolder)
	{
		// Create Output Array Structure
		$this->createOutputArrayStructure();

		// Load File
		$this->strIoFolder = $strIoFolder;
		$strFileContent = file_get_contents($strIoFolder . DIRECTORY_SEPARATOR . 'input.json');

		// Parse File
		$arrFileContent = json_decode($strFileContent, true);

		// Fill Attributes
		$this->numTurn = $arrFileContent['general']['turn'];
		$this->arrPlayer = $arrFileContent['player'];
		$this->arrPlayers = $arrFileContent['players'];
		$this->arrMap = $arrFileContent['map'];
		$this->arrSpecials = $arrFileContent['specials'];
		$this->arrLocalSession = json_decode(base64_decode($arrFileContent['session']), true);
	}

	/**
	 * public getMap
	 * Returns the Raw Map Array from the Input File
	 *
	 * @param void
	 * @return Array Map Array
	 */
	public function getMap()
	{
		return $this->arrMap;
	}

	/**
	 * public getMapFieldByCoords
	 * Returns a specific field by X and Y coorinates.
	 * 1 = Blocked, 2 = Free to go, -1 not existing
	 *
	 * @param $numX		Integer X coordinate value
	 * @param $numY		Integer Y coordinate value
	 * @return int 		ENUM (1 = Blocked, 2 = Free to go, -1 not existing)
	 */
	public function getMapFieldByCoords($numX, $numY)
	{
		if(isset($this->arrMap[$numX][$numY])) {
			return $this->arrMap[$numX][$numY];
		}
		return -1;
	}

	/**
	 * public getPlayers
	 * Returns the Raw Player Array with all Player infomrations
	 *
	 * @param void
	 * @return Array Players Array
	 */
	public function getPlayers()
	{
		return $this->arrPlayers;
	}

	/**
	 * public getPlayerById
	 * Returns a specific Player by ID. If there is no Player found the Return
	 * will be a empty Array.
	 *
	 * @param $strUuId	This is the Unique Player ID
	 * @return Array Player Array
	 */
	public function getPlayerById($strUuId)
	{
		foreach($this->players as $arrPlayer) {
			if($arrPlayer['id'] == $strUuId) {
				return $arrPlayer;
			}
		}
		return [];
	}

	/**
	 * public getPlayerByCoords
	 * Returns the Player located on a specific Coorinate on the map.
	 * If there is no Player on the coordinate the Method returns a empty Array
	 *
	 * @param $numX	The X coordinate
	 * @param $numY	The Y coordinate
	 * @return Array Player Array
	 */
	public function getPlayerByCoords($numX, $numY)
	{
		foreach($this->players as $arrPlayer) {
			if($arrPlayer['pos_x'] == $numX && $arrPlayer['pos_y'] == $numY) {
				return $arrPlayer;
			}
		}
		return [];
	}

	/**
	 * public getMyPlayer
	 * Returns the Main Player Array. The Main Player is the ship you are controlling.
	 *
	 * @param void
	 * @return Array Player Array
	 */
	public function getMyPlayer()
	{
		return $this->arrPlayer;
	}

	public function getSpecials()
	{
		return $this->specials;
	}

	public function getSpecialGroup($strGroup)
	{
		if(isset($this->specials[$strGroup])) {
			return $this->specials[$strGroup];
		}
		return [];
	}

	public function getSpecialById($strUuid)
	{
		foreach($this->specials as $arrSpecialGroup) {
			foreach($arrSpecialGroup as $arrSpecial) {
				if($arrSpecial['id'] == $strUuid) {
					return $arrSpecial;
				}
			}
		}
		return [];
	}

	public function getSpecialByCoords($numX, $numY)
	{
		foreach($this->specials as $arrSpecialGroup) {
			foreach($arrSpecialGroup as $arrSpecial) {
				if($arrSpecial['pos_x'] == $numX && $arrSpecial['pos_y'] == $numY) {
					return $arrSpecial;
				}
			}
		}
		return [];
	}

	public function actionMoveForward()
	{
		$this->arrOutput['order'] = 'MOVE_FORWARDS';
	}

	public function actionMoveBackwards()
	{
		$this->arrOutput['order'] = 'MOVE_BACKWARDS';
	}

	public function actionTurnLeft()
	{
		$this->arrOutput['order'] = 'TURN_LEFT';
	}

	public function actionTurnRight()
	{
		$this->arrOutput['order'] = 'TURN_RIGHT';
	}

	public function actionLoadCannon()
	{
		$this->arrOutput['order'] = 'LOAD_CANNON';
	}

	public function actionFireCannon($strDirection, $numPower)
	{
		$strDirection = strtolower($strDirection);
		if($strDirection == "left" || $strDirection == "right") {
			if($numPower > 0 && $numPower < 6) {
				$this->arrOutput['order'] = 'FIRE_CANNON:{"cannon":\'' . $strDirection . '\', "power":' . $numPower . '}';
			}
		}
	}

	public function setSession($strKey, $strValue) {
		$this->arrLocalSession[$strKey] = $strValue;
	}

	public function getSession($strKey, $strDefault = '') {
		if(isset($this->arrLocalSession[$strKey])) { // ilegal string offset
			return $this->arrLocalSession[$strKey];
		}
		return $strDefault;
	}

	public function log($strLogText)
	{
		echo $strLogText;
	}

	public function executeOrders()
	{
		// Write Output File
		$this->writeOutputFile();
	}

	private function createOutputArrayStructure()
	{
		$arrOutput = [];
		$arrOutput['console'] = [];
		$arrOutput['order'] = "";
		$this->arrOutput = $arrOutput;
	}

	private function writeOutputFile()
	{
		// Generate Content File String
		$strFileContent = json_encode($this->arrOutput);

		// Write File
		file_put_contents($this->strIoFolder . DIRECTORY_SEPARATOR . 'output.json', $strFileContent);
	}
}

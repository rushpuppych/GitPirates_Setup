# CodePirate.php #
This is the Codewrapper for PHP Based Ship Control Scripts. It is a very basic class that works as a Array manager. It can Read the "Input.json" file and generates the "output.json" file. It has a few simple methods that are quite useful to code your Ship Control Script with PHP.

## Public "Get Information" Methods ##
This kind of methods is giving you information about the current game situation.

### getMap ###
Get Ship is Returning a Ship Array

__Parameter__

| Param  | DataType | Description |
|--------|----------|-------------|
|        |          |             |

__Return__

| Return | DataType | Description |
|--------|----------|-------------|
|        |          |             |

### getMap ###
### getMapFieldByCoords ###
### getPlayers ###
### getPlayerById ###
### getPlayerByCoords ###
### getMyPlayer ###
### getSpecials ###
### getSpecialGroup ###
### getSpecialById ###
### getSpecialByCoords ###

## Public "Control Ship" Methods ##
This kind of methods are used to control your ship.

### actionMoveForward ###
### actionMoveBackwards ###
### actionTurnLeft ###
### actionTurnRight ###
### actionLoadCannon ###
### actionFireCannon ###

## Public "Script" Methods ##
This kind of methods are used as helper and as debugging methods.
### setSession ###
### getSession ###
### log ###

## Public "System" Methods ##
This kind of methods are used to run your script (they are necessary to run your script)
### executeOrders ###







## Structures ##
### Map Array  ###

### Players Array ###
### Player Array ###

### Specials Array ###
### Special Group Array ###
### Special Array ###

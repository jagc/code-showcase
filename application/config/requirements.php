<?php

// basic stuff
require_once('flight/Flight.php');
require_once('application/database/model.php');
require 'application/config/routes.php';
require 'application/config/app_constants.php';

// small collection of must-haves for any framework if they don't have it yet
require_once('application/libraries/miniphptools.php');
Flight::register('tools', 'MiniPhpTools');

// general functions that are too app specific
require_once('application/libraries/suffer_tools.php');
Flight::register('suffer_tools', 'SufferTools');

// interface between zklib and suffer
require_once('application/libraries/zklib/zklib_interface.php');
Flight::register('zklib', 'zklib_interface');

// interface between medoo and suffer
require_once('application/database/flight_meedo.php');
Flight::register('fmeedo', 'flightMeedo');

?>

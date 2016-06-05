<?php
  if(Flight::get('active_database_connection') == NULL)
    Flight::set('active_database_connection', 'default');

  // dev localhost
  if(Flight::get('active_database_connection') == 'default')
  {
    Flight::set('database_name', 'raw');
    Flight::set('server'       , 'localhost');
    Flight::set('username'     , 'root');
    Flight::set('password'     , 'mysql');
    Flight::set('charset'      , 'utf8');
    Flight::set('port'         , 3306);
    Flight::set('option'         , [
      PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]);
    // Flight::set('prefix'       , '');
  }

  // stage-server

  if(Flight::get('active_database_connection') == 'stage-server')
  {
    Flight::set('database_name', 'raw');
    Flight::set('server'       , 'localhost');
    Flight::set('username'     , 'root');
    Flight::set('password'     , 'qwerty321');
    Flight::set('charset'      , 'utf8');
    Flight::set('port'         , 3307);
    Flight::set('option'         , [
      PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]);
    // Flight::set('prefix'       , '');
  }
?>

<?php

include 'Http/Environment.php';
//include 'lib/database/database.php';

use Helper\Environment;
//use lib\database\Database;

Environment::load(__DIR__ . '/../');

define('URL', getenv('URL'));

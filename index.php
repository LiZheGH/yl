<?php
session_start();
ini_set("include_path", "./include");
require_once 'lib/Init.php';
require_once 'lib/Application.php';
Application::run();
// echo file_get_contents('/home/www/stob/MP_verify_nuHMjPpRVJqKozIJ.txt');
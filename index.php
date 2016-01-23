<?php
   include_once("config.php");
   include_once(APP_CONTROLLER_PATH . "/Controller.php");

   $controller = new Controller();
   echo $controller->invoke();

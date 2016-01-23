<?php
   include_once(APP_MODEL_PATH . "/Model.php");
   include_once(APP_VIEW_PATH . "/View.php");

   class Controller {
      public $model;
      public $view;

      public function __construct()
      {
         $this->model = new Model();
         $this->view = new View();
      }

      /**
       *  invoke()
       *  =================================================
       *    Handles a request from the client, requests can
       *     be for a search of the database, for a single
       *     room to be returned from the database (by room 
       *     name), for a single course to be returned (by
       *     SLN), or for a building's map div.
       *
       */
      public function invoke()
      {
         $response = null;
         if(isset($_GET['f']) && isset($_GET['q']))
         {
            //echo "f=" . $_GET['f'] . " q=" . $_GET['q'] . "\r\n"; //for testing only
            $query = $_GET['q'];
            $func = $_GET['f'];
            switch ($func) 
            {
               case "search":
                  //do search
                  return json_encode($this->model->search($query));
                  //return $this->model->search($query);
               case "room":
                  //get room
                  return json_encode($this->model->getRoomByName($query));
               case "course":
                  //get course
                  return json_encode($this->model->getCourseBySln($query));
               case "building":
                  //get building template
                  return $this->view->getBuilding($query);
            }
         }   
      }

   }

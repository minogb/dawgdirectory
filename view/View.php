<?php

   /*
    * View Class
    * =====================================================
    * The core of the view layer, handles all client requests
    *  for view templates 
    *
    */
   class View {

      //class vars
      private $buildings;

      //constructor
      public function __construct()
      {
         //choose files to read
         $this->buildings = array(
            "UW1-0" => "",
            "UW1-1" => "",
            "UW1-2" => "",
            "UW1-3" => "",
            "UW2-0" => "",
            "UW2-1" => "",
            "UW2-2" => "",
         );

         //read files into associative array
         //use reference to array value to allow assignment in loop
         foreach($this->buildings as $key => &$value)
         {
            //$value = $key;
            $value = $this->readTemplate(APP_TEMPLATE_PATH . "/" . $key . ".svg");
         }

         

      }

      //return a building template from the list
      public function getBuilding($key)
      {
         if(array_key_exists($key, $this->buildings))
         {
            return $this->buildings[$key];
         }
         return "No Template Found";
      }

      //return the contents of the requested file
      private function readTemplate($path)
      {
         if($template = file_get_contents($path))
         {
            return $template;
         }
         return "No Template Found";
      }
   }

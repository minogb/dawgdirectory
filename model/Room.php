<?php
   /*
    * Room Class
    * ================================
    * Contains classroom information.
    */
   class Room {
      public $room;
      public $special;

      public function __construct($room, $special)
      {
         $this->room = $room;
         $this->special = $special;
      }

      public function __toString()
      {
         return $this->room;
      }
   }

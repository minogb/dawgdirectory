<?php
   /*
    * Schedule Class
    * =====================================================
    * One or more schedules define a course's meeting 
    *  time(s) and room(s).
    */
   class Schedule {
      public $time;
      public $room;

      public function __construct($time, $room)
      {
         $this->time = $time;
         $this->room = $room;
      }

      public function __toString()
      {
         return $this->time . " " . $this->room;
      }
   }

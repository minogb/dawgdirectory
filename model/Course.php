<?php
   /*
    * Course Class
    * =====================================================
    * Contains information regarding a single course.
    */
   class Course {  
      public $sln;  
      public $course;  
      public $title;
      public $section;
      public $instructor;
      public $schedules;

      public function __construct($sln, $course, $title,
                                    $section, $instructor,
                                    $schedules)
      {
         $this->sln = $sln;
         $this->course = $course;
         $this->title = $title;
         $this->section = $section;
         $this->instructor = $instructor;
         $this->schedules = $schedules;
      }

      public function __toString()
      {
         $str = $this->sln . " " . $this->course . " " . 
            $this->title . " " . $this->section . " " .
            $this->instructor;
         foreach($this->schedules as $schedule)
         {
            $str = $str . " " . $schedule;
         }
         return $str;
      }
   }

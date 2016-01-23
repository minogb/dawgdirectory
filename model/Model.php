<?php
   include_once("Room.php");
   include_once("Course.php");
   include_once("Schedule.php");

   /*
    * Model Class
    * =====================================================
    * The core of the model layer, handles all interaction
    *  with the SQL database. 
    *
    * Provides various methods to retrieve course, room, 
    *  and schedule objects from database.
    *
    */
   class Model {
      //class vars
      private $mysqli;

      /**
       *  getRoomById()
       *  =================================================
       *    Returns a single room by table id.
       *
       */
      private function getRoomById($id)
      {
         $this->connectDB();

         //bind and execute query
         $prep_str = "SELECT room, special FROM rooms WHERE id=?";
         $stmt = $this->mysqli->prepare($prep_str);
         $stmt->bind_param("i", $id);
         $stmt->execute();

         //fetch results
         $room = "";
         $special = "";
         $stmt->bind_result($room, $special);

         //fetch only one
         if($stmt->fetch())
         {
            return new Room($room, $special);

         }

         return null;
      }

      /**
       *  getRoomByName()
       *  =================================================
       *    Returns a room with name matching $name.
       *
       */
      public function getRoomByName($name)
      {
         $this->connectDB();

         //bind and execute query
         $prep_str = "SELECT room, special FROM rooms WHERE room=?";
         $stmt = $this->mysqli->prepare($prep_str);
         $stmt->bind_param("s", $name);
         $stmt->execute();

         //fetch results
         $room = "";
         $special = "";
         $stmt->bind_result($room, $special);

         //fetch only once
         if($stmt->fetch())
         {
            return new Room($room, $special);

         }

         return null;

      }
      /**
       *  getCourseBySln()
       *  =================================================
       *    Returns all courses with SLNs matching $sln.
       *
       */
      public function getCourseBySln($sln)
      {
         $this->connectDB();
         
         //bind and execute query
         $prep_str = "SELECT sln, course, title, section, instructor FROM courses WHERE sln=?";
         $stmt = $this->mysqli->prepare($prep_str);
         $stmt->bind_param("i", $sln);
         $stmt->execute();

         //fetch results
         $sln = "";
         $course = "";
         $title = "";
         $section = "";
         $instructor = "";
         $stmt->bind_result($sln, $course, $title, $section, $instructor);

         //fetch once
         if($stmt->fetch())
         {
            $stmt->close();
            //get schedules linked to this course
            $schedules = $this->getSchedulesBySln($sln);
            return new Course($sln, $course, $title, $section, $instructor, $schedules);
         }

         return null;
      }

      /**
       *  getSchedulesBySln()
       *  =================================================
       *    Returns all schedules that have SLNs that
       *     match $sln. Results are formatted as
       *     "MW 1:15-3:15 UW1 102", returns an array with
       *     all matching schedules.
       *
       */
      private function getSchedulesBySln($sln)
      {
         $this->connectDB();

         //bind and execute query
         $prep_str = "SELECT t1.time, t2.room FROM schedules as t1 JOIN rooms as t2 on t1.room_id=t2.id WHERE course_sln=?";
         $stmt = $this->mysqli->prepare($prep_str);
         $stmt->bind_param("i", $sln);
         $stmt->execute();

         //fetch results
         $room = "";
         $time = "";
         $stmt->bind_result($time, $room);
         $schedules = array();
         while($stmt->fetch())
         {
            //add schedule to array
            $schedules[] = new Schedule($time, $room);
         }

         return $schedules;
      }

      /**
       *  search()
       *  =================================================
       *    Performs a search across rooms and courses for
       *     instances of $query. Returns a 2-D array of
       *     results.
       */
      public function search($query) 
      {
         //don't search if no query string
         if(!$query) {
            return null;
         }

         $this->connectDB();
       
         //bind and execute query
         $prep_str = "SELECT room, special, null, null, null, null FROM rooms WHERE room LIKE ? 
                        UNION 
                        SELECT t3.sln, t3.course, t3.title, t3.section, 
                        GROUP_CONCAT(CONCAT(t1.time, ' ', t2.room) SEPARATOR ', '), t3.instructor 
                        FROM schedules AS t1 
                        JOIN rooms AS t2 ON t1.room_id=t2.id 
                        JOIN courses AS t3 ON t3.sln=t1.course_sln 
                        WHERE course LIKE ? 
                        OR title LIKE ?
                        OR sln LIKE ?
                        OR instructor LIKE ?
                        GROUP BY sln LIMIT 12";
         $stmt = $this->mysqli->prepare($prep_str);
         $query = "%" . $query . "%"; //add wild-cards to query
         $stmt->bind_param("sssss", $query, $query, $query, $query, $query);
         $stmt->execute();


         //fetch results
         $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
         $results = array();
         while ($stmt->fetch()) {
            //array_push($results, array($col1, $col2, $col3, $col4, $col5, $col6));
            if($col3) {
               $results[] = array($col1, $col2, $col3, $col4, $col5, $col6);
            }
            elseif ($col2) {
               $results[] = array($col1, $col2);
            }
            else {
               $results[] = array($col1);
            }

         }
         $stmt->close();
         
         return $results; //return 2d array of results

      }


      /* check for current connection before making a new one
       *  log errors encountered while connecting.
       */
      private function connectDB() {
         
         if($this->mysqli == null)
         {
            $this->mysqli = new mysqli(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_DBNAME, DATABASE_PORT);
            if ($this->mysqli->connect_errno) {
               error_log("Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error,
                  3, APP_BASE_PATH . "/logging/error.log");

            }
         }

      }



   }

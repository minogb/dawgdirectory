# dawgdirectory

Team 1: Web scraping, Features, Consumer Communication
Megan Pearson- Communication/ feature design
Jeff Graham- Programming
Rio Atmadja- Programming
Robert Bezirganyan- Programming


Team 2: Campus Map, Building Maps design and website wireframing
Rebecca Lebbos - Communication/design/programming
Brittany Bentley - Requirements Design / Management / Communication
Filip Todorovic - Communication/design/programming


Team 3: Features, Specification and Process Management
Cole Goodling - Requirements Design / Management / Communication
James Clugston - Web development/programming
Robert Tunyi - Web development/programming


Team 4: Web Design / Implementation
Blong Thao - Communication / Designer
Brad Minogue - Web Master / Designer
Kosal Sieng - Communication / Designer


About the Project

Project Title: Dawg Directory

	
The Dawg Directory is an open-source program that will provide an interactive map of the University of Washington, Bothell campus, and provide its community with a visually pleasing layout of the school and the facilities, as well as the services they provide. Its value will reside in the map’s interactive abilities.
These features will include:
A search bar where users can look-up buildings and rooms by number and keyword search.
“Clickable” rooms and facilities allowing you further access to more detail such as contact information, classroom usage (courses, time used, and availability).
The school’s different facilities (i.e. the library, lab rooms, the DML, food establishments, fitness/recreation centers, parking, etc.) including hours of operation.
Map location highlighting by search query or schedule input.

There is a lot of room for expansion with this software. We have hopes to progress the Dawg Directory to display the always changing daily facility hours, alerts (e.g. a classroom change), campus events, personal profiles, GPS, and more.

The stakeholders in this project will be anyone who makes use of the UWB campus. This includes: new and current students, faculty and visitors. Of the students we surveyed, 100% said that they will find the Dawg Directory Map useful, and will use it on daily basis.
This system will begin as a web-based application, with the goal of entering the smart-phone market as a mobile app. Initially this software will be dependent on the user’s input of information, utilizing schedule data or room numbers associated with the campus layout. Initially, the Dawg Directory should not need to rely on outside systems aside from its web domain.
Census suggests there is a strong need for a detailed, interactive map for the UW Bothell’s continuously growing campus. Campus growth includes new buildings and facilities, newly enrolled and current students, and new and current staff. In regards to the students and staff, this project will offer a convenient tool for scheduling and clarity of what activities and facilities are available on campus. It will also be a boon to new students unfamiliar with the campus, allowing them to commute across campus more efficiently.
The system will be implemented with the most basic functions and is purely a software effort making it cheap to implement. As regards feasibility, this project will be fully supportable both financially and technologically within the means of our organization. The map’s expansion may require use of outside systems, such as the University’s MYUW software in order to automatically draw information from the user’s schedule or the different facilities calendars in order to update hours promptly.  



needs a config.php file @root containing
   //define path constants
   define('APP_BASE_PATH', dirname(__FILE__));
   define('APP_MODEL_PATH', APP_BASE_PATH . '/model');
   define('APP_CONTROLLER_PATH', APP_BASE_PATH . '/controller');
   define('APP_VIEW_PATH', APP_BASE_PATH . '/view');
   define('APP_TEMPLATE_PATH', APP_BASE_PATH . '/static/templates');

   //define database constants
   define('DATABASE_SERVER', '');
   define('DATABASE_USERNAME', ''); //put mysql database user name here
   define('DATABASE_PASSWORD', ''); //put mysql database password here
   define('DATABASE_DBNAME', '');
   define('DATABASE_PORT', ''); //put mysql database port here

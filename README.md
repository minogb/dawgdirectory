# dawgdirectory
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

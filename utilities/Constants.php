<?php 

namespace BokkaWP\Utilities;

/**
 * BokkaWP\Utilities\Constants
 * @version 0.0.1 Singleton
 */
class Constants
{

    private static $instance;

    public function __construct()
    {

        $this->get_instance();

        /**
         * Plugin variables
         */
        define('BOKKA_UTILITIES_DIRECTORY', plugin_dir_path(__FILE__));
        define('BOKKA_STD_ERROR', "Bokka Utilities Error: ");

        /**
         * Theme variables
         */
        define('BOKKA_PARENT_DIR',  get_template_directory());
        define('BOKKA_CHILD_DIR',   get_stylesheet_directory());

        /**
         * Environment variables
         */
        if (isset($_SERVER) && $_SERVER['HTTP_HOST']) {
            
            $host = $_SERVER['HTTP_HOST'];

            if (strpos($host, '.local') !== false) {
                define('BOKKA_ENV', "local");
            } elseif (strpos($host, 'staging') !== false) {
                define('BOKKA_ENV', "staging");
            } else {
                define('BOKKA_ENV', "production");
            }
        }
    }

    /**
     * Singleton instantiation
     * @return [static] instance
     */
    public static function get_instance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}

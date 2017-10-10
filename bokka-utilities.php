<?php

/*
Plugin Name:    Bokka Utilities
Plugin URI:     http://bokkagroup.com
Description:
Author:         Bokka Group
Version:        0.0.1
Author URI:     http://bokkagroup.com
License:        GPL2

Bokka Utilities is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Bokka Utilities is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Bokka Utilities. If not, see {License URI}.
*/

namespace BokkaWP;

/**
 * BokkaWP\Utilities
 * @version 0.0.1 Singleton
 */
class Utilities {

    private static $instance;

    public function __construct()
    {
        if (!defined('BOKKA_UTILITIES_DIRECTORY')) {
            define('BOKKA_UTILITIES_DIRECTORY', plugin_dir_path(__FILE__));
        }

        if (!defined('BOKKA_ENV') && isset($_SERVER) && $_SERVER['HTTP_HOST']) {

            $host = $_SERVER['HTTP_HOST'];

            if (strpos($host, '.local') !== false) {
                define('BOKKA_ENV', "local");
            } elseif (strpos($host, 'staging') !== false) {
                define('BOKKA_ENV', "staging");
            } else {
                define('BOKKA_ENV', "production");
            }
        }

        if (!defined('BOKKA_STD_ERROR')) {
            define('BOKKA_STD_ERROR', "Bokka Utilities Error: ");
        }

        // autoload classes in /utilites directory
        spl_autoload_register(array($this, 'utility_loader'));
    }

    /**
     * Autoload utility classes
     * @param  array $className
     * @return bool
     */
    public function utility_loader($className)
    {
        $classArray = explode('\\', $className);

        if ($classArray[0] !== "BokkaWP") {
            return;
        }

        if ($classArray[1] === "Utilities") {
            $fileName = strtolower(end($classArray)) . '.php';
        }

        if (!isset($fileName)) {
            return;
        }

        $fileURI = implode('', array(BOKKA_UTILITIES_DIRECTORY, 'utilities/', $fileName));

        // make sure the file exists
        if (!file_exists($fileURI)) {
            error_log(BOKKA_STD_ERROR . "Could not find file {" . __FILE__ . "}", 0);
            return;
        }

        // load it
        if (file_exists($fileURI)) {
            require_once($fileURI);
            return true;
        }

        return false;
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

$BokkaWPUtilities = Utilities::get_instance();

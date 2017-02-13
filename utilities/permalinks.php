<?php 

namespace BokkaWP\Utilities;

/**
 * BokkaWP\Utilities\Permalinks
 * @version 0.0.1 
 */
class Permalinks
{

    public static function get_relative($post_id)
    {
        $permalink = get_permalink($post_id);

        if ($permalink) {
            return str_replace(home_url(), '', $permalink);
        } else {
            return null;
        }
    }
}
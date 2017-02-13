<?php 

namespace BokkaWP\Utilities;

/**
 * BokkaWP\Utilities\Text
 * @version 0.0.1 
 */
class Text
{

    /**
     * Truncate text, typically for post excerpts
     * @param  string   $text   Text to truncate
     * @param  int      $limit  Number of words to limit to
     * @return string           Truncated text
     */
    public static function limit_words($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]);
            $text = trim($text);
        }
        return $text;
    }
}
<?php

namespace myProject\Framework;

class Utils
{
    /**
     * Conversion d'une chaine en caractère contenant des tirets
     * en une chaîne au format camelCase
     * @param string $str
     * @return string
     */
    public static function camelized(string $str): string // :string Sert à typer la fonction depuis PHP7
    {
        $pattern = "#(-|\_)[a-z]#";

        $camelized = preg_replace_callback(
            $pattern,
            function ($matches) {
                $matches = array_map(
                    function ($item) {
                        return strtoupper(substr($item, 1, 1));
                    }
                    , $matches
                );
                return implode('', $matches);
            },
            $str
        );

        return $camelized;
    }

}
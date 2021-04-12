<?php

namespace App\Service;

class FilterRequest
{
    public static function toInt(?string $value): ?int
    {
        if (is_null($value)) {
            return null;
        }

        if (is_bool($int = filter_var($value, FILTER_VALIDATE_INT))) {
            return null;
        }

        return $int;
    }

    public static function inArray(?string $needle, array $haystack): ?string
    {
        if (is_null($needle)) {
            return null;
        }

        if ($array_key = array_search($needle, $haystack, true) === false) {
            return null;
        }

        return $haystack[$array_key];
    }
}

<?php

namespace ApiBundle\Util;

class Base64
{
    /**
     * Check if string is valid base 64 encoded one
     *
     * @param string $string
     * @return bool
     */
    public static function isValidBase64(string $string): bool
    {
        $string = urldecode($string);

        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) {
            return false;
        }

        $decoded = base64_decode($string, true);

        if (!$decoded) {
            return false;
        }

        if (base64_encode($decoded) != $string) {
            return false;
        }

        return true;
    }

    /**
     * Decode a base64 encoded string
     *
     * @param string $encodedString
     * @return string
     */
    public static function decode(string $encodedString): string
    {
        $string = base64_decode(urldecode($encodedString));

        return $string;
    }

    /**
     * Encode a string in base64
     *
     * @param string $string
     * @return string
     */
    public static function encode(string $string): string
    {
        $encodedString = urlencode(base64_encode($string));

        return $encodedString;
    }
}

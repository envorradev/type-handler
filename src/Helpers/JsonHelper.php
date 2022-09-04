<?php

namespace Envorra\TypeHandler\Helpers;

use stdClass;

/**
 * JsonHelper
 *
 * @package Envorra\TypeHandler\Helpers
 */
class JsonHelper
{
    /**
     * @param  mixed  $value
     * @return bool
     */
    public static function isJson(mixed $value): bool
    {
        if(is_string($value)) {
            json_decode($value);
            return json_last_error() === JSON_ERROR_NONE;
        }
        return false;
    }

    /**
     * @param  mixed  $value
     * @return bool
     */
    public static function isJsonable(mixed $value): bool
    {
        return method_exists($value, 'toJson');
    }

    /**
     * @param  string  $json
     * @return object
     */
    public static function toObject(string $json): object
    {
        return (object) json_decode($json, false);
    }

    /**
     * @param  string  $json
     * @return array
     */
    public static function toArray(string $json): array
    {
        return (array) json_decode($json, true);
    }

    /**
     * @param  mixed  $value
     * @return string
     */
    public static function toJson(mixed $value): string
    {
        if(static::isJson($value)) {
            return $value;
        }

        if(static::isJsonable($value)) {
            return $value->toJson();
        }

        return json_encode($value);
    }

    /**
     * @param  mixed  $json
     * @return object|null
     */
    public static function tryToObject(mixed $json): ?object
    {
        if(static::isJson($json)) {
            return static::toObject($json);
        }
        return null;
    }

    /**
     * @param  mixed  $json
     * @return array|null
     */
    public static function tryToArray(mixed $json): ?array
    {
        if(static::isJson($json)) {
            return static::toArray($json);
        }
        return null;
    }
}

<?php

namespace Envorra\TypeHandler\Providers;

/**
 * Package
 *
 * @internal
 */
class Package
{
    private const BASE_PATH = __DIR__.'/../..';

    private const ROOT_PATH = self::BASE_PATH.'/src';

    /**
     * @param  string|null  $path
     * @param  bool         $realPath
     * @return string
     */
    public static function basePath(?string $path = null, bool $realPath = true): string
    {
        return self::pathHelper(self::BASE_PATH, $path, $realPath);
    }

    /**
     * @param  string|null  $path
     * @param  bool         $realPath
     * @return string
     */
    public static function path(?string $path = null, bool $realPath = true): string
    {
        return self::pathHelper(self::ROOT_PATH, $path, $realPath);
    }

    /**
     * @param  string       $path
     * @param  string|null  $segment
     * @param  bool         $realPath
     * @return string
     */
    private static function pathHelper(string $path, ?string $segment, bool $realPath): string
    {
        $path .= ($segment && !str_contains($segment, '..') ? '/'.$segment : '');

        $path = preg_replace('#[/\\\\]+#', DIRECTORY_SEPARATOR, $path);

        return $realPath ? realpath($path) : $path;
    }
}

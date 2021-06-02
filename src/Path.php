<?php

namespace Francerz\FileSystem\Utils;

abstract class Path
{
    public static function normalizeSlash(string $path) : string
    {
        return strtr($path, ['\\'=>'/']);
    }

    public static function osSlash(string $path) : string
    {
        return strtr($path, ['\\'=>DIRECTORY_SEPARATOR, '/'=>DIRECTORY_SEPARATOR]);
    }

    private static function joinRecursive(string $path, array $append)
    {
        foreach ($append as $a) {
            if (is_array($a)) {
                $path = static::joinRecursive($path, $a);
                continue;
            }
            if (empty($a)) continue;
            $a = static::normalizeSlash($a);
            $path = rtrim($path,'/').'/'.ltrim($a,'/');
        }
        return $path;
    }

    /**
     * Join two or more path segments
     *
     * @param string $path
     * @param array|string|null ...$append
     * @return string
     */
    public static function join(string $path, ...$append) : string
    {
        $path = static::normalizeSlash($path);
        $path = static::joinRecursive($path, $append);
        return $path;
    }
}
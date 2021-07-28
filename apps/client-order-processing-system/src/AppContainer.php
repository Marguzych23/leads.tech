<?php


namespace Marguzych23\ClientOrderProcessingSystem;


class AppContainer
{
    private static array $objects = [];
    private static array $paths   = [];

    /**
     * @param string $class_name
     * @param object $object
     * @param bool   $force_replace
     */
    public static function setObject(string $class_name, object $object, bool $force_replace = false)
    {
        if (!isset(self::$objects[$class_name]) || $force_replace) {
            self::$objects[$class_name] = $object;
        }
    }

    /**
     * @param string $class_name
     *
     * @return mixed|null
     */
    public static function getObject(string $class_name): ?object
    {
        return self::$objects[$class_name] ?? null;
    }

    /**
     * @param string      $name
     * @param string|null $path
     *
     * @return string|null
     */
    public static function path(string $name, ?string $path = null): ?string
    {
        if (is_null($path)) {
            if (isset(self::$paths[$name])) {
                return self::$paths[$name];
            }
        } elseif (trim($name) && trim($path)) {
            self::$paths[$name] = $path;
        }

        return null;
    }
}
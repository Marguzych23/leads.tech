<?php


namespace Marguzych23\ClientOrderProcessingSystem\Data;


abstract class AbstractData
{
    const MAX_DATA_COUNT = 1000;
    protected static int   $count = 0;
    protected static array $data  = [];

    /**
     * @return array
     */
    public static function getAll()
    {
        return static::$data;
    }

    /**
     * @param             $value
     * @param string|null $key
     *
     * @throws \ArgumentCountError
     */
    public abstract static function set($value, ?string $key = null): void;
//    {
//        if (self::isContainerFull()) {
//            throw new \ArgumentCountError('Контейнер заполнен');
//        }
//
//        self::$data[] = $value;
//        self::$count++;
//    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public abstract static function get(string $key);
//    {
//        return self::$data[$key] ?? null;
//    }

    /**
     *
     */
    public static function clean()
    {
        static::$data  = [];
        static::$count = 0;
    }


    /**
     * @return bool
     */
    public static function isContainerFull()
    {
        if (static::$count === static::MAX_DATA_COUNT) {
            return true;
        }

        return false;
    }
}
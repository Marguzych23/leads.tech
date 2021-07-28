<?php


namespace Marguzych23\ClientOrderProcessingSystem\Data;

class DataContainer extends AbstractData
{
    const MAX_DATA_COUNT = 100;

    /**
     * @inheritDoc
     */
    public static function set($value, ?string $key = null): void
    {
        if (self::isContainerFull()) {
            throw new \ArgumentCountError('Контейнер заполнен');
        }

        self::$data[] = $value;
        self::$count++;
    }

    /**
     * @inheritDoc
     */
    public static function get(string $key)
    {
        return static::$data[$key] ?? null;
    }
}
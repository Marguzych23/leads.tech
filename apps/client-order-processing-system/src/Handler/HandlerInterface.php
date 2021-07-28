<?php


namespace Marguzych23\ClientOrderProcessingSystem\Handler;


interface HandlerInterface
{
    /**
     * @param object $object
     *
     * @return void
     */
    public static function handle(object $object): void;

}
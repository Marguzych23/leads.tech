<?php


namespace Marguzych23\ClientOrderProcessingSystem\Logger;


interface LoggerInterface extends \Psr\Log\LoggerInterface
{
    /* Log Levels */
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';
    const LOG       = 'log';

}
<?php

use Marguzych23\ClientOrderProcessingSystem;

set_time_limit(600);

$project_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

ClientOrderProcessingSystem\AppContainer::path('app', $project_path);

$file_logger = new ClientOrderProcessingSystem\Logger\FileLogger();
ClientOrderProcessingSystem\AppContainer::setObject(ClientOrderProcessingSystem\Logger\FileLogger::class, $file_logger);

<?php


require realpath(__DIR__)
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . 'load.php';

use LeadGenerator\Lead;
use LeadGenerator\Generator;

$start = new DateTime(); // текущее время на сервере

print 'Start generate and handle leads' . PHP_EOL;
$generator = new Generator();
$generator->generateLeads(10000, function (Lead $lead) {
    Marguzych23\ClientOrderProcessingSystem\Handler\LeadHandler::handle($lead);
});
print 'End handle leads' . PHP_EOL;

$script_execution_interval = (new DateTime())->diff($start);

print 'Script execution time '
    . $script_execution_interval->i . ':' . $script_execution_interval->s
    . PHP_EOL;
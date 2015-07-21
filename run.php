#!/usr/bin/env php
<?php

require "vendor/autoload.php";
require "functions.php";

banner();

if (!isset($argv[1])) {
    echo "You must provide the event ID (an integer) as a parameter.\n\n";
    usage();
}

$eventId = (int)$argv[1];

if ($eventId <= 0) {
    echo "The event ID must be a positive integer.\n\n";
    usage();
}

echo "Finding a random comment... ";
$selectedComment = reset(getEvent(
    $eventId,
    getRandomNumber(getEvent($eventId)->meta->total)
)->comments);
echo " done!\n\n";

echo str_repeat("-", 30) . "\n";
echo strtoupper($selectedComment->talk_title) . "\n";
echo str_repeat("-", 30) . "\n";
echo "  - by " . $selectedComment->user_display_name . "\n";
echo "  - rated " . $selectedComment->rating . " out of 5" . "\n";
echo "  - on " . (new DateTime($selectedComment->created_date))->format('d/m/Y H:i:s') . "\n";
echo str_repeat("=", 30) . "\n";
echo $selectedComment->comment . "\n\n";

#!/usr/bin/env php
<?php

require "functions.php";

banner();

if (!isset($argv[1])) {
    echo "You must provide the event stub as a parameter.\n\n";
    usage();
}

if (preg_match('/[^a-zA-Z0-9-_]/', $argv[1])) {
    echo "Event stub should only have a-z, 0-9, - or _\n\n";
    usage();
}

echo "Finding a random comment... ";
$talkCommentsUri = getTalkCommentsUriFromStub($argv[1]);
if (null === $talkCommentsUri) {
    echo "FAILED.\n\nEvent stub was not found on Joind.in.\n\n";
    usage();
}

$totalCommentsCount = getTalkComments($talkCommentsUri)->meta->total;
if (!$totalCommentsCount) {
    echo "FAILED.\n\nThere were no comments to pick from.\n\n";
    usage();
}

$selectedComment = reset(getTalkComments($talkCommentsUri, getRandomNumber($totalCommentsCount))->comments);
echo " done!\n\n";

echo str_repeat("-", 30) . "\n";
echo strtoupper($selectedComment->talk_title) . "\n";
echo str_repeat("-", 30) . "\n";
echo "  - by " . $selectedComment->user_display_name . "\n";
echo "  - rated " . $selectedComment->rating . " out of 5" . "\n";
echo "  - on " . (new DateTime($selectedComment->created_date))->format('d/m/Y H:i:s') . "\n";
echo str_repeat("=", 30) . "\n";
echo $selectedComment->comment . "\n\n";

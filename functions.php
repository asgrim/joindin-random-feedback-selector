<?php

require_once "vendor/autoload.php";

/**
 * Print usage and die.
 */
function usage()
{
    global $argv;
    echo "Usage:  " . $argv[0] . " [eventStub]\n";
    die();
}

/**
 * Print the banner
 */
function banner()
{
    $banner = "Joind.in Random Feedback Selector -- by @asgrim";
    echo $banner . "\n";
    echo str_repeat("=-", ceil(strlen($banner) / 2)) . "\n\n";
}

/**
 * Given an event stub, look up the "all talk comments" URI
 *
 * @param string $stub
 * @return string
 */
function getTalkCommentsUriFromStub($stub)
{
    $joindinEventsBaseUrl = 'http://api.joind.in/v2.1/events';

    $events = json_decode(
        (new GuzzleHttp\Client())->get(sprintf(
            '%s?stub=%s&verbose=yes',
            $joindinEventsBaseUrl,
            $stub
        ))->getBody()
    )->events;

    if (!isset($events[0])) {
        return null;
    }

    return $events[0]->all_talk_comments_uri;
}

/**
 * Fetch all the talk comments for an event ID. Returns an object.
 *
 * @see http://joindin.github.io/joindin-api/events.html
 * @param string $talkCommentsUri
 * @param int $start
 * @return object
 */
function getTalkComments($talkCommentsUri, $start = 0)
{
    return json_decode((new GuzzleHttp\Client())->get(sprintf(
        '%s?start=%d&resultsperpage=1',
        $talkCommentsUri,
        (int)$start
    ))->getBody());
}

/**
 * Find a random number between $min and $max, using random.org API.
 *
 * @see https://www.random.org/clients/http/
 * @param int $max
 * @param int $min
 * @return int
 */
function getRandomNumber($max, $min = 0)
{
    return (int)(string)(new GuzzleHttp\Client())->get(sprintf(
        'https://www.random.org/integers/?num=1&min=%d&max=%d&col=1&base=10&format=plain&rnd=new',
        $min,
        $max
    ))->getBody();
}

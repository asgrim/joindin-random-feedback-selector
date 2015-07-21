<?php

function usage()
{
    global $argv;
    echo "Usage:  " . $argv[0] . " [eventId]\n";
    die();
}

function banner()
{
    $banner = "Joind.in Random Feedback Selector -- by @asgrim";
    echo $banner . "\n";
    echo str_repeat("=-", ceil(strlen($banner) / 2)) . "\n\n";
}

function getEvent($eventId, $start = 0)
{
    return json_decode((new GuzzleHttp\Client())->get(sprintf(
        'http://api.joind.in/v2.1/events/%d/talk_comments?start=%d&resultsperpage=1',
        (int)$eventId,
        (int)$start
    ))->getBody());
}

function getRandomNumber($max, $min = 0)
{
    return (int)(string)(new GuzzleHttp\Client())->get(sprintf(
        'https://www.random.org/integers/?num=1&min=%d&max=%d&col=1&base=10&format=plain&rnd=new',
        $min,
        $max
    ))->getBody();
}

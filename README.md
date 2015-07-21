Joind.in Random Feedback Selector
=================================

A little tool that selects a random piece of feedback on an event on Joind.in and displays it.

Usage:

```shell
$ git clone git@github.com:asgrim/joindin-random-feedback-selector.git
$ composer install
$ ./run.php phpsc15
Joind.in Random Feedback Selector -- by @asgrim
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

Finding a random comment...  done!

------------------------------
PARALLEL PHP
------------------------------
  - by Luke Steadman
  - rated 5 out of 5
  - on 20/07/2015 09:39:17
==============================
Exceptional talk. Really insightful and a great way to introduce Parallel PHP.

$
```

The only parameter to `run.php` is the event stub, which you can get from the "quicklink" URL on the Joind.in event.

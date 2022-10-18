<?php

namespace app\src\display;

use app\src\display\IDisplay;

class CLIDisplay implements IDisplay
{
    const DISPLAY_MODE = 'cli';

    public function __construct(public array $tags)
    {
    }

    public function view(): void
    {
        header('HTTP/1.1 200');
        header('Content-Type: text/plain; charset=utf-8');

        echo sprintf('Count: %d', count($this->tags)) . PHP_EOL;
        print_r($this->tags);
        exit();
    }
}
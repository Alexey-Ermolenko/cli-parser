<?php

namespace app\src\display;

use app\src\display\IDisplay;

class JsonDisplay implements IDisplay
{
    const DISPLAY_MODE = 'json';

    public function __construct(public array $tags)
    {
    }

    public function view(): void
    {
        header('HTTP/1.1 200');
        header('Content-type: application/json; charset=utf-8');

        echo json_encode(array_merge(['count' => count($this->tags)], ['tags' => $this->tags])) . PHP_EOL;
        exit();
    }
}
<?php

namespace app\src\display;

use app\src\display\IDisplay;

class HtmlDisplay implements IDisplay
{
    const DISPLAY_MODE = 'html';

    public function __construct(public array $tags)
    {
    }

    public function view(): void
    {
        header('HTTP/1.1 200');
        header('Content-Type: text/html; charset=utf-8');

        echo '<h1>'. count($this->tags) .'</h1><p>'. implode(', ', $this->tags) .'</p>';
        exit();
    }
}
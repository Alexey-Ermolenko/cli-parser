<?php

declare(strict_types=1);

namespace app\src;

use app\src\display\Display;
use app\src\parser\Parser;
use Exception;

class Context
{
    private Parser $parser;
    private array $tags;

    /**
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $resource
     * @throws Exception
     */
    public function setTags(string $resource): void
    {
        $this->tags = $this->parser->getHtmlTags($resource);
    }

    /**
     * @param string $displayMode
     * @return Display
     * @throws Exception
     */
    public function display(string $displayMode): Display
    {
        return new Display($this->tags, $displayMode);
    }
}
<?php

namespace app\src\display;

use Exception;

class Display
{
    protected array $tags;
    public IDisplay $display;

    /**
     * @param array $tags
     * @param string $displayMode
     * @throws Exception
     */
    public function __construct(array $tags, string $displayMode)
    {
        $this->tags = $tags;
        $this->display = $this->defineDisplay($displayMode);
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string $displayMode
     * @return IDisplay
     * @throws Exception
     */
    private function defineDisplay(string $displayMode): IDisplay
    {
        try {
            return match ($displayMode) {
                JsonDisplay::DISPLAY_MODE => new JsonDisplay($this->getTags()),
                HtmlDisplay::DISPLAY_MODE => new HtmlDisplay($this->getTags()),
                CLIDisplay::DISPLAY_MODE => new CLIDisplay($this->getTags())
            };
        } catch (\UnhandledMatchError $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function view(): void
    {
        $this->display->view();
    }
}
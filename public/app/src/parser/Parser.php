<?php

namespace app\src\parser;

abstract class Parser implements HtmlTagsGetter {
    protected function getTags(string $html): array {
        $result = [];

        if (preg_match_all('/<([^\/!][a-z1-9]*)/i', $html,$matches)) {
            $result = $matches[1];
        }

        return $result;
    }
}
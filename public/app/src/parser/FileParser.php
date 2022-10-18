<?php

namespace app\src\parser;

use Exception;

class FileParser extends Parser {

    /**
     * @param $resource
     * @return array
     * @throws Exception
     */
    public function getHtmlTags($resource): array
    {
        try {
            $html = file_get_contents($resource);

            return self::getTags($html);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
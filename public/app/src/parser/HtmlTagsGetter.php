<?php

namespace app\src\parser;

use Exception;

interface HtmlTagsGetter {
    /**
     * @param $resource
     * @return array
     * @throws Exception
     */
    public function getHtmlTags($resource): array;
}
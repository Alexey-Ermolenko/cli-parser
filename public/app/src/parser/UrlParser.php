<?php

namespace app\src\parser;

use Exception;

class UrlParser extends Parser {

    /**
     * @param $resource
     * @return array
     * @throws Exception
     */
    public function getHtmlTags($resource): array
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $resource);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            return self::getTags($response);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
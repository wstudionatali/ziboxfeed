<?php

/**
 * Class ZiboxApiExporter
 *
 * test api: http://api.marketplace.preprod.ziboxtech.com
 * prod api: https://api.marketplace.prod.ziboxtech.com
 */

class ZiboxApiExporter
{
    const METHOD_CATEGORIES_EXPORT = 'categories/export';

    const METHOD_CHARACTERISTICS_EXPORT = 'characteristics/export';

    private $base_api_url = 'http://api.marketplace.prod.ziboxtech.com';

    public function __construct($base_api_url = null)
    {
        if ($base_api_url) {
            $this->base_api_url = $base_api_url;
        }
    }

    public function get_parsed_ziboxcats_ar()
    {
        return $this->curlRequestToZibox(self::METHOD_CATEGORIES_EXPORT, []);
    }

    public function get_cat_branch_array($id)
    {
        $result = $this->curlRequestToZibox(self::METHOD_CATEGORIES_EXPORT, ['id' => $id]);
        return $this->convertNestedArray2Linear($result);
    }
   public function get_zibox_cat($id = null)
    {
        return $this->curlRequestToZibox(self::METHOD_CATEGORIES_EXPORT, $id ? ['id' => $id] : []);
    }
    public function get_zibox_characteristics($id = null)
    {
        return $this->curlRequestToZibox(self::METHOD_CHARACTERISTICS_EXPORT, $id ? ['id' => $id] : []);
    }

    private function curlRequestToZibox($method, $params = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_api_url . '/' . $method . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE );
        curl_close($ch);
        if ($statusCode == 200) {
            $result = json_decode($output);
            if (!empty($result) && property_exists($result, 'result')) {
                return json_decode(json_encode($result->result), true);
            }
  zibox_log("Url connection failed, check if url ".$base_api_url." is correct and try again");
            return [];
        }
  zibox_log("Url connection failed, check if url ".$base_api_url." is correct and try again");
        return [];
    }

    private function convertNestedArray2Linear($array, $arrayKey = 'child') {
        $result = [];
        foreach ($array as $value) {
            $arrayKeyData = $value[$arrayKey];
            unset($value[$arrayKey]);
            $result[] = $value;
            if (!empty($arrayKeyData)) {
                $result = array_merge($result, $this->convertNestedArray2Linear($arrayKeyData));
            }
        }

        return $result;
    }
}


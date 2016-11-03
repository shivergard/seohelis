<?php
 
namespace App\Traits;

trait FeedHelper {

    private function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

    public function readFeed($url) {

        $return = array();

        if (strpos($url , 'http') === 0 && $this->get_http_response_code($url) == 200){
            $contents = file_get_contents($url);   
        }else{
            $contents = ""; 
        }

        try {

            libxml_use_internal_errors(true);
            $xml=simplexml_load_string($contents);
            $errors = libxml_get_errors();

            if (is_object($xml) && $xml->channel && $xml->channel->item && count($xml->channel->item) > 0){
                foreach ($xml->channel->item as $key => $item) {
                    $return[] = array(
                        'title' => $item->title,
                        'link' => $item->link,
                        'description' => $item->description,
                        'pubDate' => $item->pubDate
                    );
                }
            }       
        } catch (Exception $e) {
            
        }

        return $return;
    }
}
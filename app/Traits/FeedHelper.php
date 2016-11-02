<?php
 
namespace App\Traits;

trait FeedHelper {

    public function readFeed($url) {

        $return = array();

        $contents = file_get_contents($url);

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
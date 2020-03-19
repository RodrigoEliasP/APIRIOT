<?php


class RIOT_API
{
    private $key = null;
    protected function setKey($key)
    {
        if(!empty($key))  $this->key = $key;

    }
    protected function request($endpoint = "")
    {
        $uri = "https://br1.api.riotgames.com/" . $endpoint . "?api_key=" . $this->key;
        $result = @file_get_contents($uri);

        if(is_string($result)){
            return json_decode($result);
        }else{
            return 001;
        }

    }
}
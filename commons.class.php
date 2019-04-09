<?php

class Commons {

    public $curl_url;
    public $headers = array();

    function getHeaders() {
        return $this->headers;
    }
    
    function setHeaders($header) {
        array_push($this->headers, $header);
    }

    function curl_execute() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->curl_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);

        echo "before curl setopt\n";
        print_r($this->getHeaders());
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo "##########################" . "\n";
            echo "Error:" . curl_error($ch) . "\n";
            echo "##########################" . "\n";

            // make recursive if fails
            curl_execute($url);
        }
        curl_close ($ch);

        return $result;
    }

    function explodeArguments($args) {
        $paramArguments = array();
        foreach ($args as $arg) {
            $argExplode = explode("::", $arg);
            $paramKey   =   str_replace("--", "", $argExplode[0]);
            $paramValue =   $argExplode[1];
            if($paramValue) {
                $paramArguments[$paramKey] = $paramValue;
            }
        }
        return $paramArguments;
    }
    
    

}

?>
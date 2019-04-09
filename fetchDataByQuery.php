<?php
ini_set('memory_limit', '256M');
date_default_timezone_set('America/New_York');

include 'commons.class.php';

$common = new Commons;
$cmdArguments = $common->explodeArguments($argv);

// set headers
$common->setHeaders("Accept: application/json");
$common->setHeaders("X-Query-Key: <<X_QUERY_KEY>>");

// set curl url
$common->curl_url = "https://insights-api.newrelic.com/v1/accounts/<<ORG_ACCOUNT_ID>>/query?nrql=";
if($cmdArguments['query']) {
    $common->curl_url = $common->curl_url . $cmdArguments['query'];
}

// print_r($common->getHeaders());

// execute curl
$results = $common->curl_execute();
print_r($results);

?>

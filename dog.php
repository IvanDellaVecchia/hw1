<?php
session_start();

$api_key = '20b43e8d-e979-4cea-866b-0b37d0c45e43';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.thedogapi.com/v1/breeds');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('x-api-key: '.$api_key));

$result=curl_exec($curl);
curl_close($curl);
echo $result;

?>
<?php
function bindFromRequest($class_name, $data){
    if(!isset($data) || count($data) == 0) return false;
    $data = (object)$data;
    $entity = create_entity($class_name);
    foreach($entity as $key => $value){
        if(isset($data->$key)){
            $entity->$key = $data->$key;
        }
    }
    return $entity;
}

function getDataRequest($className, $data){

    if(!isset($data) || count($data) == 0) return false;
    $data = (object)$data;

    $file = DIR_STRUCT_DATA."request/".$className.".php";
    require_once $file;
    $request = new $className;

    foreach($request as $key => $value){
        if(isset($data->$key)){
            $request->$key = $data->$key;
        }
    }
    return $request;
}

function createRequestFromEntity($class_name, $entity){
    $request = create_entity($class_name);
    return $request->createData($entity);
}
function httpPost($url,$pvars,$timeout = 30){
    if(!isset($timeout))
        $timeout=30;
    $curl = curl_init();
    $post = http_build_query($pvars);

    curl_setopt ($curl, CURLOPT_URL, $url);
    curl_setopt ($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt ($curl, CURLOPT_HEADER, 0);
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt ($curl, CURLOPT_POST, 1);
    curl_setopt ($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt ($curl, CURLOPT_HTTPHEADER,array("token" => "token", "sandbox" => false));
    $html = curl_exec ($curl);
    curl_close ($curl);
    return $html;
}
function httpGet($url, $timeout=30){
    if(!isset($timeout))
        $timeout=30;
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $url);
    curl_setopt ($curl, CURLOPT_TIMEOUT, $timeout);
    // curl_setopt ($curl, CURLOPT_HEADER, (int)$header);
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($curl, CURLOPT_HTTPHEADER,array("token" => "token", "sandbox" => false));
    curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec ($curl);
    curl_close ($curl);
    return $response;
}
function encodePostData($data){
    return base64_encode(json_encode($data));
}
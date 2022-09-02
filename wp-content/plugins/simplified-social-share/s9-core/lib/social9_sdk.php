<?php

class Social9
{
    public $apiDomain;

    function __construct()
    {
        $this->apiDomain = "https://api.social9.com/";
    }
    function login($email, $password)
    {
        return $this->requestClient("api/v1/auth/login", array(
            "Email" => $email,
            "Password" => $password
        ), "post", array(
            'Content-Type' => 'application/json'
        ));
    }
    function register($name, $email, $password)
    {
        return $this->requestClient("api/v1/auth/register", array(
            "Email" => $email,
            "Password" => $password,
            "FirstName" => $name
        ), "post", array(
            'Content-Type' => 'application/json'
        ));
    }
    function generateApikey($uid, $APIKeyLabel, $accessToken)
    {
        return $this->requestClient("api/v1/auth/generateapikey", array(
            "Uid" => $uid,
            "Name" => $APIKeyLabel
        ), "post", array(
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ));
    }
    function getAccessToken($uid, $APIKey)
    {
        return $this->requestClient("api/v1/auth/accesstoken", array(
            "user_id" => $uid,
            "apikey" => $APIKey
        ));
    }
    /* Widget Start */
    function getWidgetList($uid)
    {
        return $this->requestClient("api/v1/widgets/", array(
            "user_id" => $uid
        ));
    }
    function getWidgetByWidgetId($uid,$wid)
    {
        return $this->requestClient("api/v1/widgets/", array(
            "user_id" => $uid,
            "widget_id" => $wid
        ));
    }
    function updateWidget($uid, $wid, $accessToken, $payload)
    {
        return $this->requestClient("api/v1/widgets/?user_id=" . $uid . "&widget_id=" . $wid, $payload, "put", array(
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ));
    }
    function createWidget($uid, $accessToken, $payload)
    {
        return $this->requestClient("api/v1/widgets/?user_id=" . $uid, $payload, "post", array(
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ));
    }
    function deactiveWidget($uid, $wid, $accessToken){
        return $this->requestClient("api/v1/widgets/action/deactivate?user_id=".$uid."&widget_id=".$wid, array(), "post", array(
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ));
    }
    function activeWidget($uid, $wid, $accessToken){
        return $this->requestClient("api/v1/widgets/action/activate?user_id=".$uid."&widget_id=".$wid, array(), "post", array(
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ));
    }
    /* Widget End */
    function requestClient($Path, $options = array(), $method = "get", $headers = false)
    {
        $method = strtoupper($method);
        $args = array(
            'method'     => $method,
            'timeout'   => 20
        );
        if ($headers) {
            $args['headers'] = $headers;
        }
        $requestURL = $this->apiDomain . $Path;
        if ($method == 'POST' || $method == 'PUT') {
            $args['body'] = json_encode($options);
        } else {
            $requestURL .= (($method == 'GET') ? ('?' . http_build_query($options)) : null);
        }
        $response = wp_remote_request($requestURL, $args);
        $body = json_decode(wp_remote_retrieve_body($response),true);
        if(isset($body['data']) && !empty($body['data'])){
            return $body['data'];
        }else{
            if(isset($body['type']) && $body['type'] == "unauthorized"){
                $uid = get_option('social9_account_id');
                $apikey = get_option('social9_apikey');
                $getAccessToken = $this->getAccessToken($uid, $apikey);
                if (isset($getAccessToken["access_token"]) && !empty($getAccessToken["access_token"])) {
                    S9_Social_Sharing::set_options(array(
                        'account_id' => $uid,
                        'apikey' => $apikey,
                        'access_token' => $getAccessToken["access_token"]
                    ));
                    $headers['Authorization'] = 'Bearer ' . $getAccessToken["access_token"];
                    $this->requestClient($Path, $options, $method, $headers);
                }
            }else{
                return $body;
            }
        }
    }
}

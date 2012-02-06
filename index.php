<?php
    require('config.php');
    require('php-plurk-api/plurk_api.php');

    $payload = json_decode($_POST['payload']);
    error_log(print_r($payload, true));

    function doPlurk($msg)
    {
        global $plurk_api_key;
        global $plurk_username;
        global $plurk_password;

        $plurk = new plurk_api();
        $plurk->login($plurk_api_key, $plurk_username, $plurk_password);

        $plurk->addPlurk('tr_ch', 'says', "$msg");
    }

?>

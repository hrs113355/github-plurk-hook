<?php
    require('config.php');
    require('php-plurk-api/plurk_api.php');

    $payload = json_decode($_POST['payload']);
    $repo_name = $payload->repository->name;
    $commits = $payload->commits;
    foreach ($commits as $c)
    {
	$author = $c->author->name;
	$url = get_tinyurl($c->url);
	$msg = $c->message;

	$post_msg = "[$repo_name] $url $author - $msg";
	doPlurk($post_msg);
    }

    function get_tinyurl($url)
    {
	return file_get_contents('http://tinyurl.com/api-create.php?url='.$url);
    }

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

<?php

require_once('./vendor/autoload.php');

use Sauron\UpdatesDrupalOrg\ReleaseHistory\ReleaseHistoryClient;

$client = new ReleaseHistoryClient();
$releases = $client->getReleases('views', '7.x');

var_dump($releases);

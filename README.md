Drupal Release History
=======================
A simple PHP client to fetch releases from updates.drupal.org webservice.

Note that this library uses Guzzle as a third party library to handle HTTP
requests.

INSTALL
--------

Use composer

    composer require "drupal-sauron/drupal-release-history":"dev-master"

HOW TO
-------

How to fetch module releases from a given core version?

    use Sauron\UpdatesDrupalOrg\ReleaseHistory\ReleaseHistoryClient;
    $client = new ReleaseHistoryClient();
    $releases = $client->getReleases('views', '7.x');

How to fetch all module releases?

    use Sauron\UpdatesDrupalOrg\ReleaseHistory\ReleaseHistoryClient;
    $client = new ReleaseHistoryClient();
    $releases = $client->getReleases('views', 'all');

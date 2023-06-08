<?php

namespace Deployer;

require_once 'recipe/magento2.php';

// add production server
host('m2test.wdtdemo.nl')
    ->setHostname('m2test.wdtdemo.nl')
    ->setRemoteUser('app')
    ->setLabels(['stage' => 'production'])
    ->set('branch', 'master')
    ->set('deploy_path','$HOME/domains/m2test.wdtdemo.nl/application');

// Project name
set('application', 'M2 test website');

// Project repository
set('repository', 'git@github.com:aartse/m2test.git');

// Keep 2 releases
set('keep_releases', 2);

// add extra shared dirs
add('shared_dirs', [
    'pub/sitemaps',
]);

// empty clear_paths, is not needed because all paths are saved in release
set('clear_paths', []);

// make sure Deployer uses composer with our own PHP version
// this can also be composer2.phar
set('bin/composer', '/usr/local/bin/composer2');

// tag the release with datetime for an easy overview of when deployments happened
set('release_name', date('YmdHis'));

// set the Apache user to make sure Deployer deploys files with the right owner
// this is our vhost user
set('http_user', get('user'));

// since we have no root permissions, this should be changed to chmod
set('writable_mode', 'chmod');

// deploy assets
/*
set('static_content_locales', 'nl_NL en_US');
set('magento_themes', [
    'Magento/backend',
]);
*/

// Unlock deploy on failure
after('deploy:failed', 'deploy:unlock');

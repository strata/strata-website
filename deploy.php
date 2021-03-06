<?php
namespace Deployer;

require 'recipe/common.php';
require 'vendor/studio24/deployer-recipes/all.php';

/**
 * Deployment configuration variables - set on a per-project basis
 */

// Friendly project name
$project_name = 'Strata Website';

// The repo for the project
$repository = 'git@github.com:strata/strata_website.git';

// Array of remote => local file locations to sync to your local development computer
$sync = [
    'images' => [
    ],
];

// Shared files that are not in git and need to persist between deployments (e.g. local config)
$shared_files = [
    ];

// Shared directories that are not in git and need to persist between deployments (e.g. uploaded images)
$shared_directories = [
    ];

// Sets directories as writable (e.g. uploaded images)
$writable_directories = [
    ];

// Custom (non-root) composer installs required
$composer_paths = [
    ];


/**
 * Apply configuration to Deployer
 *
 * Don't edit beneath here unless you know what you're doing!
 *
 * DO NOT store the Slack hook in a public repo
 */


set('application', $project_name);
set('repository', $repository);
set('shared_files', $shared_files);
set('shared_dirs', $shared_directories);
set('writable_dirs', $writable_directories);
set('sync', $sync);
set('http_user', 'apache');
set('webroot', 'web');
set('slack_webhook', 'https://hooks.slack.com/services/XXXXX/XXXXX/xxxxxx');
set('keep_releases', 10);
set('git_tty', true);
set('allow_anonymous_stats', false);

// Default stage - prevents accidental deploying to production with dep deploy
set('default_stage', 'staging');

/**
 * Hosts
 */

host('production')
    ->stage('production')
    ->user('deploy')
    ->hostname('63.34.69.8 ')
    ->set('deploy_path', '/data/var/www/vhosts/strata.dev/production')
    ->set('url', 'https://www.strata.dev');

host('staging')
    ->stage('staging')
    ->user('deploy')
    ->hostname('63.34.69.8 ')
    ->set('deploy_path', '/data/var/www/vhosts/strata.dev/staging')
    ->set('url', 'https://staging.strata.dev');


/**
 * Deployment task
 * The task that will be run when using dep deploy
 */

desc('Deploy ' . get('application'));
task('deploy', [
    // Run initial checks
    'deploy:info',
    's24:check-branch',
    's24:show-summary',
    's24:display-disk-space',

    // Request confirmation to continue (default N)
    's24:confirm-continue',

    // Deploy site
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',

    // Composer install
    'deploy:vendors',

    'deploy:shared',
    'deploy:writable',
    'deploy:clear_paths',
    's24:build-summary',

    // Build complete, deploy is live once deploy:symlink runs
    'deploy:symlink',

    // Cleanup
    'deploy:unlock',
    'cleanup',
    'success'
]);

// Slack notification on successful deploy to prod
// after('success', 's24:notify-slack');

// Add unlock to failed deployment event.
after('deploy:failed', 'deploy:unlock');

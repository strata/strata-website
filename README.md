# Client Site name

Static website for Strata, built using [Apollo](https://github.com/studio24/apollo). Hosted on AWS Single Cloud 1. 

## Getting started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See [deployment](#deployment) for how to deploy the project to staging and live environments. 

Also see more [detailed project documentation](docs/README.md) and the [project license](LICENSE.md).

### In this document

* [Site URLs](#site-urls)
* [Installing](#installing)
* [Deployment](#deployment)
* [Syncing tasks](#syncing-tasks)
* [Built with](#built-with)
* [Credits](#credits)

## Site URLs

### Live
* https://www.strata.dev
* https://www.strata.dev/_build_summary.json

### Staging
* https://staging.strata.dev
* https://staging.strata.dev/_build_summary.json

### Development
* http://strata.localhost

## Installing

### Requirements

- PHP 7.4
- Node v12.16.0
- [NPM](https://www.npmjs.com/)
- [NVM](https://github.com/creationix/nvm)
- [Composer](https://getcomposer.org/)
- [Deployer](https://deployer.org/docs/installation)

### Installing locally

How to get your local development environment running.

#### Clone repo:

````bash
git clone git@github.com:strata/strata_website.git
````

#### Install PHP dependencies:

```php
composer install
```

#### Install project dependencies:

From within the project root

```bash
# Switch your version of Node to the correct version for this project (see .nvmrc)
nvm use

# Install dependencies
npm install
npm run build
```

### Build

To re-build the assets once

```bash
npm run build
```

To watch for changes

```bash
npm run watch
```

## Configuration

Any details on configuration files required. 

## Making changes

To make changes to code first work on a branch and create a Pull Request to merge changes into the `main` branch.

All changes to the `main` branch need to pass continuous integration tests (PHP linting, PHP code standards). 
See [workflow](.github/workflows/README.md) for more. 

## Deployment

The site uses Deployer for deployment (installed via Composer). Please note if no branch is specified your current branch is used.

### Deploy to Live

You should always deploy the `main` branch to production.

````
./vendor/bin/dep deploy production --branch=main
````

### Deploy to Staging

Before deployment please check the [currently deployed branch](https://staging.example.com/_build_summary.json)

````
./vendor/bin/dep deploy staging --branch=branch-name-to-deploy
````

## Syncing tasks

Sync files from production or staging to your local development environment. These are setup in the `deploy.php` script, 
see the [sync](https://github.com/studio24/deployer-recipes/blob/main/docs/sync.md) task for more.

#### Sync assets: Live → Local development

````bash
./vendor/bin/dep sync production --files=images
````
#### Sync assets: Staging → Local development

````bash
./vendor/bin/dep sync staging --files=images
````

## Built with

- [Apollo 2](https://apollo.studio24.net/) - Front-end starter kit

## Credits
- **Alan Isaacson** - *Support Developer* - Studio 24
- **Simon Jones** - *Managing Director* - Studio 24
- **Isaac Lowe** - *Design Strategy Director* - Studio 24


# GitHub workflows

## Github actions

We use [GitHub actions](https://docs.github.com/en/actions) to run automated actions on any merge into the default branch (main).

## PHP

Tests the project across different versions of PHP. The default workflow runs:

* PHP linting (is the code syntax valid?)
* Code formatting (does the PHP code meet our coding standards?)

### PHP linting

We use (PHPLint)[https://github.com/overtrue/phplint] to test PHP files for syntax errors. This package runs a lot faster 
than trying to run a bash command for `php -l`.

Config: `.phplint.yml`

By default, we exclude the vendor folder and test all other PHP files in the project.

Run manually via `./vendor/bin/phplint`

### Code formatting

We use [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to test PHP files to ensure they meet our coding 
standards. This helps maintenance and working in a team.

Config: `phpcs.yml`

By default, we test for the [PSR12 coding standard](https://www.php-fig.org/psr/psr-12/) and we test PHP files in the 
path `src`. Edit this path if your PHP files are stored elsewhere (see the `file` tag).

Run manually via `./vendor/bin/phpcs`

#### Fixing code issues automatically

Use PHP Code Beautifier and Fixer (`phpcbf`) to automatically fix code issues. 

Run manually via `./vendor/bin/phpcbf`

## Automated testing

No default testing setup is included. The following options are recommended:

* [PHPUnit](https://phpunit.de/) - unit testing (testing small components of code)
* [Behat](https://docs.behat.org/en/latest/) - end-to-end testing (testing web page interaction in a browser)

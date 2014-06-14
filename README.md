Laravel HTMLMin
===============


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-HTMLMin/master.svg)](https://travis-ci.org/GrahamCampbell/Laravel-HTMLMin)
[![Coverage Status](https://img.shields.io/coveralls/GrahamCampbell/Laravel-HTMLMin/master.svg)](https://coveralls.io/r/GrahamCampbell/Laravel-HTMLMin)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg)](https://github.com/GrahamCampbell/Laravel-HTMLMin/blob/master/LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-HTMLMin.svg)](https://github.com/GrahamCampbell/Laravel-HTMLMin/releases)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-HTMLMin/badges/quality-score.png?s=b56aacf6a0c1b2e612c3d7dab63d212084e6b83b)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-HTMLMin)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/bd487912-2c9a-454e-85f7-270928cf0c5f/mini.png)](https://insight.sensiolabs.com/projects/bd487912-2c9a-454e-85f7-270928cf0c5f)


## What Is Laravel HTMLMin?

Laravel HTMLMin is a simple HTML minifier for [Laravel 4.2+](http://laravel.com).

* Laravel HTMLMin was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).
* Laravel HTMLMin relies on Mr Clay's [Minify](https://github.com/mrclay/minify) package.
* Laravel HTMLMin uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-HTMLMin) with [Coveralls](https://coveralls.io/r/GrahamCampbell/Laravel-HTMLMin) to check everything is working.
* Laravel HTMLMin uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-HTMLMin) and [SensioLabsInsight](https://insight.sensiolabs.com/projects/bd487912-2c9a-454e-85f7-270928cf0c5f) to run additional checks.
* Laravel HTMLMin uses [Composer](https://getcomposer.org) to load and manage dependencies.
* Laravel HTMLMin provides a [change log](https://github.com/GrahamCampbell/Laravel-HTMLMin/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-HTMLMin/releases), and [api docs](http://grahamcampbell.github.io/Laravel-HTMLMin).
* Laravel HTMLMin is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/Laravel-HTMLMin/blob/master/LICENSE.md).


## System Requirements

* PHP 5.4.7+ or HHVM 3.1+ is required.
* You will need [Laravel 4.2+](http://laravel.com) because this package is designed for it.
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel HTMLMin.


## Installation

Please check the system requirements before installing Laravel HTMLMin.

To get the latest version of Laravel HTMLMin, simply require `"graham-campbell/htmlmin": "~2.0"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel HTMLMin is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\HTMLMin\HTMLMinServiceProvider'`

You can register the HTMLMin facade in the `aliases` key of your `app/config/app.php` file if you like.

* `'HTMLMin' => 'GrahamCampbell\HTMLMin\Facades\HTMLMin'`


## Configuration

Laravel HTMLMin supports optional configuration.

To get started, first publish the package config file:

    php artisan config:publish graham-campbell/htmlmin

There are a few config options:

**Automatic Blade Optimizations**

This option (`'blade'`) enables minification of the the blade views as they are compiled. These optimizations have little impact on php processing time as the optimizations are only applied once and are cached. This package will do nothing by default to allow it to be used without minifying pages automatically. The default value for this setting is `false`.

**Force Blade Optimizations**

This option (`'force'`) forces blade minification on views where there such minification may be dangerous. This should only be used if you are fully aware of the potential issues this may cause. Obviously this setting is dependent on blade minification actually being enabled. The default value for this setting is `false`.

**Automatic Live Optimizations**

This option (`'live'`) enables minification of the html responses just before they are served. These optimizations have greater impact on php processing time as the optimizations are applied on every request. This package will do nothing by default to allow it to be used without minifying pages automatically. The default value for this setting is `false`.


## Usage

**Classes\HTMLMin**

This is the class of most interest. It is bound to the ioc container as `'htmlmin'` and can be accessed using the `Facades\HTMLMin` facade. There are three public methods of interest.

The `'html'` method will parse a string as html and will minify it as best as possible using Mr Clay's [Minify](https://github.com/mrclay/minify) package. This is the method that is automatically used in an after filter when live minification is enabled.

The `'blade'` method will parse a string as blade and minify it as quickly as possible. This is method the compiler class uses when blade minification is enabled.

The `'live'` method accepts a response object as a first parameter and will first determine if it can be minified, and then will set the response body to a minified version of the body of the response using the html minifier.

**Facades\HTMLMin**

This facade will dynamically pass static method calls to the `'htmlmin'` object in the ioc container which by default is the `Classes\HTMLMin` class.

**HTMLMinServiceProvider**

This class contains no public methods of interest. This class should be added to the providers array in `app/config/app.php`. This class will setup ioc bindings and register automatic blade/live minification based on the config.

**Filters**

You may put the `htmlmin` filter in front of your routes to live minify their responses. This filter will always minify them even when live minification is disabled because the live minification config setting defines if all html responses should be minified. This filter allows you to selectively choose which routes to minify.

**Further Information**

There are other classes in this package that are not documented here. This is because they are not intended for public use and are used internally by this package.

Feel free to check out the [API Documentation](http://grahamcampbell.github.io/Laravel-HTMLMin
) for Laravel HTMLMin.

You may see an example of implementation in [Laravel Navigation](https://github.com/GrahamCampbell/Laravel-Navigation) or [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## Updating Your Fork

Before submitting a pull request, you should ensure that your fork is up to date.

You may fork Laravel HTMLMin:

    git remote add upstream git://github.com/GrahamCampbell/Laravel-HTMLMin.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).

You can then update the branch:

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.


## Pull Requests

Please review these guidelines before submitting any pull requests.

* When submitting bug fixes, check if a maintenance branch exists for an older series, then pull against that older branch if the bug is present in it.
* Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title.
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).


## License

Apache License

Copyright 2013-2014 Graham Campbell

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

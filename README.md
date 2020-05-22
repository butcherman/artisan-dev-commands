# Butcherman\Artisan-Dev-Commands

A simple collection of Artisan commands to help make your development troubleshooting a little easier.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/butcherman/artisan-dev-commands/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/butcherman/artisan-dev-commands/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/butcherman/artisan-dev-commands/badges/build.png?b=master)](https://scrutinizer-ci.com/g/butcherman/artisan-dev-commands/build-status/master)
[![Build Status](https://travis-ci.com/butcherman/artisan-dev-commands.svg?branch=master)](https://travis-ci.com/butcherman/artisan-dev-commands)
[![GitHub release](https://img.shields.io/github/release/Butcherman/artisan-dev-commands)](https://GitHub.com/Butcherman/artisan-dev-commands/releases/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Latest Stable Version](https://poser.pugx.org/butcherman/artisan-dev-commands/v/stable)](https://packagist.org/packages/butcherman/artisan-dev-commands)

## Requirements

- PHP 7.2 or Higher
- Laravel 5.5 or Higher

## Installation

```php
composer require butcherman/artisan-dev-commands --dev
```

## Usage

### Log File Commands

Note:  only the Single Log and Daily Log channels are supported at this time

Clear the contents of the current log file while keeping the file itself in tact:

```php
php artisan log:clean
```

Delete all log files in the Log directory (will only remove files with the .log extension)

```php
php artisan log:purge
```

Create a new dedicated class called a Domain in a separate folder under App\Domains that can be reused throughout the application

```php
php artisan make:domain DomainName   #  Note - to put a domain in a sub folder, enter the folder name followed by domain name - i.e. folder\name
```

## Copyright © 2019-2020 Butcherman

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

See the LICENSE file for additional information

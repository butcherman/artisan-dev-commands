# Butcherman\Artisan-Dev-Commands

A simple collection of Artisan commands to help make your development troubleshooting a little easier.

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

Clear the contents of the current log file while keeping the file itself in tact:

```php
php artisan log:clean
```

Delete all log files in the Log directory (will only remove files with the .log extension)

```php
php artisan log:purge
```

Create a new Laravel Trait in the app/Traits folder

```php
php artisan make:trait TraitName    //  or  Folder/TraitName
```

Create a new Vue page located at /resources/js/Pages with a basic Vue template.  Adding a new Vue page in a sub folder uses the dot (.) syntax similar to the View syntax

```php
php artisan make:page Folder.pageName   //  To add the component using the Vue's Options API, add the --optionsApi flag
```

Create a new Vue component located at /resources/js/Components with a basic Vue template.  Adding a new Vue component in a sub folder uses the dot (.) syntax similar to the View syntax

```php
php artisan make:vuecomponent Folder.componentName      //  To add the component using the Vue's Options API, add the --optionsApi flag
```

## Copyright © 2019-2022 Butcherman

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

See the LICENSE file for additional information

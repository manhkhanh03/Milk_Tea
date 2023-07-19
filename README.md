## Server environment
+ `Apache or Nginx`
+ `PHP >= 7.3`
+ `MySQL >=5.7`
+ `Nodejs >= v12.22.7` [https://nodejs.org/en/download/]

## =====================================================================

## Laravel document: 
- https://laravel.com/docs/8.x/installation
- https://laravel.com/docs/4.2/quick

## ======================================================================

## INSTALLATION for PRODUCTION
- Clone project and cd to project directory

- Run `cp .env.example .env`

- Create new database in mysql

- Config App url, environment, database connection, mailer in file `.env`

- Run `composer install` [install all Packagist to vendor folder]

- Run `php artisan key:generate`

- Run `php artisan migrate` [Create a table in an already created database]

- Run `php artisan db:seed` [import data default]

- Run `php artisan storage:link` [Public storage folder]

- Run `npm install`

- Run `npm run prod` or `npm run production`


## Typically, you may use a web server such as Apache or Nginx to serve your Laravel applications. If you are on PHP 5.4+ and would like to use PHP's built-in development server, you may use the serve Artisan command:

- `php artisan serve`

You can run site with link: http://127.0.0.1:8000 or http://localhost:8000


## By default the HTTP-server will listen to port 8000. However if that port is already in use or you wish to serve multiple applications this way, you might want to specify what port to use. Just add the --port argument:

- `php artisan serve --port=8080`

You can run site with link: http://127.0.0.1:8080` or `http://localhost:8080

## ============================================================================

## For Local development

- Install software in guide `local/README`

- Start Development server by running command `vagrant up`

- Stop server by command `vagrant halt`
- Access SSH server by command `vagrant ssh`
- Project path (in development server) is `/workplace`
- Seed example data by command `php artisan db:seed`
- Build assets (js/css) by command `npm run dev`
- Watching assets change by command `npm run watch-poll`
- Ide helper by command `php artisan ide-helper:generate` and `php artisan ide-helper:meta`

## =============================================================================
About Netsuite
http://www.netsuite.com/help/helpcenter/en_US/srbrowser/Browser2017_1/schema/record/salesorder.html?mode=package

https://hotexamples.com/examples/-/NetSuiteService/-/php-netsuiteservice-class-examples.html

Amazon API document:
https://developer-docs.amazon.com/sp-api/docs/feeds-api-v2021-06-30-use-case-guide
https://developer-docs.amazon.com/sp-api/docs/feed-type-values 
https://images-na.ssl-images-amazon.com/images/G/01/rainier/help/xsd/release_4_1/OrderFulfillment.xsd

Amazon API SDK:
https://github.com/jlevers/selling-partner-api/tree/main/docs/Api
https://github.com/jlevers/selling-partner-api/blob/main/docs/Model/Feeds/CreateFeedSpecification.md 

Mirak API:
Document: https://catch-dev.mirakl.net/help/api-doc/seller/mmp.html
SDK:
https://github.com/mirakl/sdk-php-shop

Bat dau khoi tao react

npm ci && npm run dev
# Yii2-basic-RESTful-API-template
Simple web api

Basic web api using POST or GET method with json response

[![Latest Stable Version](https://poser.pugx.org/rockielin/yii2-basic-restful-api-template/v/stable.png)](https://packagist.org/packages/rockielin/yii2-basic-restful-api-template)
[![Total Downloads](https://poser.pugx.org/rockielin/yii2-basic-restful-api-template/downloads.png)](https://packagist.org/packages/rockielin/yii2-basic-restful-api-template)

INSTALLATION
------------

You can choose to install the application using one of the following methods.

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.1"
php composer.phar create-project --prefer-dist --stability=dev rockielin/yii2-basic-restful-api-template project-name
~~~

Enable debug:
-------------
create file "develop.me" in /config/

Request:
--------
all request using POST or GET method.

POST parameter validate using in controller:
```php
$this->checkParms(["parm1",
  "parm2",.....]);
```

Response:
--------
success reqponse format:
```php
{"data":json object,"status":200}
```
error reqponse format:
```php
{"data":"message","status":status code}
```
example of error output:
```php
throw new \yii\web\HttpException(401, "authentication failed!");
```


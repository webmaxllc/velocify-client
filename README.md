Velocify API client
================

- [![Build Status](https://travis-ci.org/webmax/velocify-client.svg?branch=master)](https://travis-ci.org/webmax/velocify-client) master
- [![Build Status](https://travis-ci.org/webmax/velocify-client.svg?branch=1.0)](https://travis-ci.org/webmax/velocify-client) 1.0

The Velocify API client is a PHP library which provides simplified access to
the [Velocify API](http://velocify.com) and the data it returns.

> This plugin is currently in development with no stable release. Stay tuned for
> an actual release soon.

Requirements
------------

- PHP 5.6 and above
- See the `require` section of [composer.json](composer.json)

Documentation
-------------

For information on how to utilize the various components provided by this
library please read [the documentation](docs/index.md). Full API documentation
can also be found in [the docs/api](docs/api/index.html) folder.

Installation
------------

### Include the library

Open a command console, enter your project directory and execute the following
command to download the latest stable release:

```bash
$ composer require webmax/velocify-client "~1.0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Quick Start
-----------

```php
// Writeme
```

Contributing
------------

If there is anything you believe to be missing or an error, please send a pull
request with your changes. I'd really appreciate the help! Please make sure to
include working unit tests, and that any changes you make have been tested and
do not break current features.

Testing
-------

We hope to remain at 100% unit test coverage for the entire lifespan of this
project; lofty goal, for sure, but doable. To run the test suite first install
the library then run the following command from the root folder of the project:

```bash
$ ./vendor/bin/phpunit
```

Or, if you already have phpunit installed globally this will do:

```bash
$ phpunit
```

Thanks
------

- [Velocify](http://velocify.com) - API creator
- [GuzzleHTTP](http://docs.guzzlephp.org) - Base client library
- [JMS Serializer](http://jmsyst.com/libs/serializer) - JSON deserializer
- [PHPUnit](https://phpunit.de/) - PHP testing framework

# Require Login for Yii2 Application

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/webtoolsnz/yii2-require-login/badges/quality-score.png?b=master&s=c31d25819240ab85a1d0e29828f4801099fcfaf2)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-require-login/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/webtoolsnz/yii2-require-login/badges/coverage.png?b=master&s=7d2ba07523b96249052fac819faf57962692fe86)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-require-login/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/webtoolsnz/yii2-require-login/badges/build.png?b=master&s=4397a434491a90f89f9de8f4868598571db4b65b)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-require-login/build-status/master)

Simple component that enforces a blanket authentication requirement for all controller/actions.
  
Provides a configurable list of exceptions.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add the following to your `composer.json` file.

~~~
    "require" : {
        "webtoolsnz/yii2-require-login": "*"
    }, 
    "repositories": [
        {
            "type": "composer",
            "url": "https://packages.webtools.nz"
        }
    ]
~~~

## Configuration Examples

### Basic Configuration
~~~
...
'components' => [
    'requireLogin' => [
        'class' => 'webtoolsnz\RequireLogin\Component',
    ]
],
...
~~~

### Custom Exception List
`yii2-require-login` will by default provide a list of basic route exceptions including: `login` `logout`
you can override this list with your own list using the below config.

~~~
...
'components' => [
    'requireLogin' => [
        'class' => 'webtoolsnz\RequireLogin\Component',
        'exceptions' => [
            '/login',
            '/logout',
            '/my-controller/foo'
        ]
    ]
],
...
~~~


## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

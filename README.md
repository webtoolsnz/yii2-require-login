# Require Login for Yii2 Application

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


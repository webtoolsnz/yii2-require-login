<?php
/**
 * @link https://gihub.com/webtoolsnz/yii2-require-login
 * @copyright Copyright (c) 2015 Webtools Ltd
 */
namespace webtoolsnz\RequireLogin;

use Yii;

/**
 * Class RequireLogin
 * @package app\components
 */
class Component extends \yii\base\Component implements \yii\base\BootstrapInterface
{
    /**
     * @var array
     */
    public static $exceptions = [
        '',
        'login',
        'logout',
        'user/login',
        'user/forgot-password',
        'user/reset-password',
        'debug/default/toolbar',
        'debug/default/view',
    ];

    /**
     * Bootstrap method is executed on every request, checks to see if the current route
     * requires authentication if the user is not already authenticated.
     *
     * @param \yii\base\Application $app
     * @return void|\yii\web\Response
     * @throws \yii\web\ForbiddenHttpException
     */
    public function bootstrap($app)
    {
        if (Yii::$app instanceof \yii\console\Application || !Yii::$app->getUser()->isGuest || $this->isExceptionRoute($this->getRoute())) {
            return;
        }

        $app->on(\yii\web\Application::EVENT_BEFORE_REQUEST, function ($event) {
            $event->handled = true;
            $user = Yii::$app->getUser();
            $request = Yii::$app->getRequest();
            $url = $request->getUrl();

            if ($user->loginUrl === null || $request->isAjax) {
                throw new \yii\web\ForbiddenHttpException(Yii::t('yii', 'Login Required'));
            }

            $user->setReturnUrl($url);
            Yii::$app->getResponse()->redirect((array) $user->loginUrl);
            Yii::$app->end();
        });
    }

    /**
     * Determine if the given route is an exception
     *
     * @param $url
     * @return bool
     */
    public function isExceptionRoute($route)
    {
        foreach(self::$exceptions as $exception) {
           if ($exception === $route || (substr($exception, 0, 2) === '/^' && preg_match($exception, $route) === 1)) {
                return true;
           }
        }

        return false;
    }

    /**
     * Returns the current route (eg. /user/login)
     * excluding the QueryString.
     *
     * @return string
     */
    public function getRoute()
    {
        try {
            $path = Yii::$app->getRequest()->getPathInfo();
        } catch(\yii\base\InvalidConfigException $e) {
            $path = '';
        }

        return $path;
    }

    /**
     * @param $value
     */
    public function setExceptions($value)
    {
        self::$exceptions = $value;
    }
}


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
    public $exceptions = [
        '/login',
        '/logout',
        '/user/login',
        '/user/forgot-password',
        '/user/reset-password',
        '/debug/default/toolbar',
        '/debug/default/view',
    ];

    /**
     * If set to true allows partial matches for exceptions
     *
     * @var bool
     */
    public $matchPartial = false;

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
        if (!Yii::$app instanceof \yii\web\Application || !Yii::$app->getUser()->isGuest) {
            return;
        }

        $user = Yii::$app->getUser();
        $request = Yii::$app->getRequest();

        if (!$this->isExceptionRoute($this->getRoute()) ) {
            if ($user->loginUrl === null) {
                throw new \yii\web\ForbiddenHttpException(Yii::t('yii', 'Login Required'));
            }

            $user->setReturnUrl($request->getUrl());
            Yii::$app->getResponse()->redirect((array) $user->loginUrl);
            Yii::$app->end();
        }
    }

    /**
     * Determine if the given route is an exception
     *
     * @param $url
     * @return bool
     */
    public function isExceptionRoute($route)
    {
        if (false === $this->matchPartial) {
            return in_array($route, $this->exceptions);
        }

        foreach($this->exceptions as $exception) {
            if (strncmp($exception, $route, strlen($exception)) === 0) {
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
        return '/'.Yii::$app->getRequest()->getPathInfo();
    }
}


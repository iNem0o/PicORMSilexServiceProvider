<?php
namespace PicORM\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * PicORM Silex Service Provider
 * Allow you to easily use PicORM with Silex microframework
 *
 * @category ServiceProvider
 * @package  PicORM
 * @author   iNem0o <contact@inem0o.fr>
 * @license  LGPL http://opensource.org/licenses/lgpl-license.php
 * @link     https://github.com/iNem0o/PicORMSilexServiceProvider
 */
class PicORMServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['db'] = $app->share(function () use ($app) {
            return new \PDO('mysql:dbname=' . $app['picorm.database'] . ';host=' . $app['picorm.server'], $app['picorm.username'], $app['picorm.password']);
        });
    }

    public function boot(Application $app)
    {
        \PicORM\PicORM::configure(array(
                                      'datasource' => $app['db']
                                  ));
    }
}

# PicORM Silex ServiceProvider
Combine PicORM and Silex to quickly build powerful application

## Usage
Registering the provider give you full access to PicORM but let you access to a PDO instance in ``$app['db']`` too.


```php
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use PicORM\Silex\Provider\PicORMServiceProvider;


$config = array(
    'picorm.database' => 'databasename',
    'picorm.server' => 'localhost',
    'picorm.username' => 'user',
    'picorm.password' => 'pass'
);

$app = new Application();


/*
    CREATE TABLE IF NOT EXISTS `brands` (
      `idBrand` int(11) NOT NULL AUTO_INCREMENT,
      `nameBrand` varchar(100) NOT NULL,
      `noteBrand` float DEFAULT 0,
      PRIMARY KEY (`idBrand`)
    ) ENGINE=InnoDB ;
*/

class Brand extends \PicORM\Model
{
    protected static $_tableName = 'brands';
    protected static $_primaryKey = "idBrand";
    protected static $_relations = array();

    protected static $_tableFields = array(
        'nameBrand',
        'noteBrand'
    );

    public $idBrand;
    public $nameBrand;
    public $noteBrand;

}

$app->register(new PicORMServiceProvider(), $config);

$app->match('/index.html', function(Request $request) {
    var_dump($app['db']); // PDO instance
    // you can now access to models
    $brands = Brand::find();

    $brand = new Brand();
    $brand -> nameBrand = 'brand1';
    $brand -> noteBrand = 5;
    $brand -> save();
});
$app->run();
```

##License

LGPL License

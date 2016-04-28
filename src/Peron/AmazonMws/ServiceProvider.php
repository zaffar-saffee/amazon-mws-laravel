<?php namespace Peron\AmazonMws;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use anlutro\LaravelSettings\Facade as Setting;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*$configPath = __DIR__ . '/../../config/amazon-mws.php';
        $this->mergeConfigFrom($configPath, 'amazon-mws');*/
        $this->readyConfig ();

        $this->app->alias('AmazonOrderList', 'Peron\AmazonMws\AmazonOrderList');
        $this->app->alias('AmazonOrderItemList', 'Peron\AmazonMws\AmazonOrderItemList');
        $this->app->alias('AmazonReportRequest', 'Peron\AmazonMws\AmazonReportRequest');
        $this->app->alias('AmazonReportList', 'Peron\AmazonMws\AmazonReportList');
        $this->app->alias('AmazonOrderItemList', 'Peron\AmazonMws\AmazonOrderItemList');
    }

    public function boot()
    {
        /*$configPath = __DIR__ . '/../../config/amazon-mws.php';
        $this->publishes([$configPath => config_path('amazon-mws.php')], 'config');*/
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    /**
     * take array and
     */
    private function readyConfig ()
    {
        $configStore = [
            'store' => [
                Setting::get('storeName') => [
                    'merchantId' => Setting::get('merchantId'),
                    'marketplaceId' => Setting::get('marketplaceId'),
                    'keyId' => Setting::get('keyId'),
                    'secretKey' => Setting::get('secretKey'),
                    'amazonServiceUrl'=> Setting::get('amazonServiceUrl'),
                ]
            ],

            // Default service URL
            'AMAZON_SERVICE_URL' => 'https://mws.amazonservices.com/',

            'muteLog' => false
        ];
        $key= 'amazon-mws';
        $this->app['config']->set($key,  $configStore);
        
    }

}

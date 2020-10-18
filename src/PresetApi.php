<?php

namespace Laravelha\Api;

use Illuminate\Support\Facades\File;
use Laravel\Ui\Presets\Preset;

class PresetApi extends Preset
{
    const STUBSPATH = __DIR__ . '/stubs';

    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install(): void
    {
        static::publishSwaggerConfig();
        static::updateWebRouteDoc();
        static::updateBaseController();
        static::appendGenerateAlways();
        static::appendConstHost();
    }

    /**
     * update PHP Unit
     *
     * @return void
     */
    protected static function updatePhpUnit(): void
    {
        File::delete(base_path('phpunit.xml'));
        File::copy(self::STUBSPATH.'/phpunit.stub', base_path('phpunit.xml'));
    }

    /**
     * Publish Cors Config
     *
     * @return void
     */
    protected static function publishCorsConfig(): void
    {
        File::copy(self::STUBSPATH.'/config/cors.stub', config_path('cors.php'));
    }

    /**
     * Update Http Kernel.php
     *
     * @return void
     */
    protected static function updateHttpKernel(): void
    {
        File::delete(app_path('Http/Kernel.php'));
        File::copy(self::STUBSPATH.'/app/Http/Kernel.stub', app_path('Http/Kernel.php'));
    }

    /**
     * Update Http Kernel.php
     *
     * @return void
     */
    protected static function updateWebRouteDoc(): void
    {
        File::delete(base_path('routes/web.php'));
        File::copy(self::STUBSPATH.'/routes/web.stub', base_path('routes/web.php'));
    }

    /**
     * Publish Swagger Config
     *
     * @return void
     */
    protected static function publishSwaggerConfig(): void
    {
        File::copy(self::STUBSPATH.'/config/l5-swagger.stub', config_path('l5-swagger.php'));
    }

    /**
     * Update Base Controller
     *
     * @return void
     */
    protected static function updateBaseController(): void
    {
        File::delete(app_path('Http/Controllers/Controller.php'));
        File::copy(self::STUBSPATH.'/app/Http/Controllers/Controller.stub', app_path('Http/Controllers/Controller.php'));
    }

    /**
     * Append Generate Always
     *
     * @return void
     */
    protected static function appendGenerateAlways(): void
    {
        File::append(base_path('.env'), "\nL5_SWAGGER_GENERATE_ALWAYS=true\n");
        File::append(base_path('.env.example'), "L5_SWAGGER_CONST_HOST=http://localhost:8000\n");
    }

    /**
     * Append Const Host
     *
     * @return void
     */
    protected static function appendConstHost(): void
    {
        File::append(base_path('.env'), "L5_SWAGGER_CONST_HOST=http://localhost:8000\n");
        File::append(base_path('.env.example'), "L5_SWAGGER_CONST_HOST=http://localhost:8000\n");
    }
}

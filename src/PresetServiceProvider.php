<?php

namespace Laravelha\Api;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;

class PresetServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        UiCommand::macro('ha-api', function (Command $command) {

            $command->call('preset', ['type' => 'none']);

            PresetApi::install();

            $command->info('API scaffolding installed successfully.');
            $command->comment("Publish the config to copy the file to your own config: php artisan vendor:publish --tag='cors'");
            $command->comment("add the HandleCors middleware on app/Http/Kernel.php");
            $command->comment("Publish config: php artisan vendor:publish --provider 'L5Swagger\L5SwaggerServiceProvider'");
            $command->comment("Add OA Server and Info notation");
            $command->comment("Generate doc: php artisan l5-swagger:generate");
        });
    }
}

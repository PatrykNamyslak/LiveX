<?php
namespace LiveX;

use LiveX\Services\RequestInterceptor;
use Probe\Support\Contracts\Service;
use Probe\Support\Contracts\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider{
    public function register(): void{
        // SERVICES
        $this->bind(serviceClass: RequestInterceptor::class, factory: fn(): Service => new RequestInterceptor);

        // COMMANDS
        $this->addCommand(command: "make:livex", logic: function(){
            // ADD LOGIC!!!
        });
    }
}
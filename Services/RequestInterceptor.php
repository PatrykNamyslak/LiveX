<?php
namespace LiveX\Services;

use LiveX\Support\Http\Request;
use Probe\Support\Contracts\Service;
use Probe\Support\JSONResponse;


class RequestInterceptor implements Service{
    /**
     * An array of intercepted Requests
     * @var Request[]
     */
    public array $requests = [];

    public function intercept(): void{
        $this->requests[] = Request::capture();
    }
}
<?php
namespace LiveX\Support;

use LiveX\Support\Enums\HtmxHttpMethod;
use LiveX\Support\Enums\HtmxTrigger;


abstract class Translation{
    /**
     * Defines what method attribute will be used i.e: `hx-put` or `hx-get`
     * @return HtmxHttpMethod
     */
    public function method(): HtmxHttpMethod{
        return HtmxHttpMethod::POST;
    }

    abstract public function trigger(): HtmxTrigger;
}
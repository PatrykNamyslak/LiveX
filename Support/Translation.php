<?php
namespace LiveX\Support;

use LiveX\Enums\HtmxHttpMethod;
use LiveX\Enums\HtmxTrigger;


abstract class Translation{
    /**
     * Defines what method attribute will be used i.e: `hx-put` or `hx-get`
     * @return string
     */
    public static function method(): HtmxHttpMethod{
        return HtmxHttpMethod::PUT;
    }

    abstract public static function trigger(): HtmxTrigger;
}
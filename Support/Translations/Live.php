<?php
namespace LiveX\Support\Translations;

use LiveX\Translation;
use LiveX\Enums\HtmxTrigger;


abstract class Live extends Translation{
    public static function trigger(): HtmxTrigger{
        return HtmxTrigger::OnChange;
    }
}
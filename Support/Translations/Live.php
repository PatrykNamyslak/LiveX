<?php
namespace LiveX\Support\Translations;

use LiveX\Support\Translation;
use LiveX\Support\Enums\HtmxTrigger;


class Live extends Translation{
    public function trigger(): HtmxTrigger{
        return HtmxTrigger::OnChange;
    }
}
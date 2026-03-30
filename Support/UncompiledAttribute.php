<?php
namespace LiveX\Support;

use LiveX\Support\Enums\Directive;

/**
 * Data object used to store the raw html before compiling it into HTMX attributes: 
 * * `$attribute = livex:click="increment"` -> `livex:$directive="$action"`
 */
class UncompiledAttribute{

    /**
     * @param string $attribute The raw HTML attribute
     * @param Directive $directive
     * @param string $action
     */
    public function __construct(public string $attribute, public Directive $directive, public string $action){}

}
<?php
namespace LiveX\Support;

use Probe\Support\Traits\Stringable;


/**
 * Data object to store a compiled attribute from `Compiler::compile()`
 */
class CompiledAttribute{
    use Stringable;

    public string $body;


    public function __tostring(): string{
        return $this->body;
    }

    /**
     * @param Translation $translation An object that holds the HTMX translations
     * @param string $action The action to take, this can be a:
     * * URL
     * * Method on the requested Component
     */
    public function __construct(public Translation $translation, public string $action){
        $this->body = $translation->method()->value . '="/livex/update/" ' . $translation->trigger()->value;
    }
}
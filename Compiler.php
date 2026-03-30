<?php
namespace LiveX;

use LiveX\Support\CompiledAttribute;
use LiveX\Support\UncompiledAttribute;

use Probe\Support\Traits\Singleton;


class Compiler{
    use Singleton;

    /**
     * Compile an attribute to HTMX attributes
     */
    public function compile(UncompiledAttribute $attribute): CompiledAttribute{
        return new CompiledAttribute(translation: $attribute->directive->translate(), action: $attribute->action);
    }

    /**
     * Alias of `Compiler::compile()`
     */
    public function translate(UncompiledAttribute $attribute): CompiledAttribute{
        return $this->compile(attribute: $attribute);
    }
}
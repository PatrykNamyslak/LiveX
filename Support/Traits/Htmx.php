<?php
namespace LiveX\Support\Traits;

use PatrykNamyslak\Builders\HtmlElement;

trait Htmx{
    /**
     * Stores whether or not htmx was injected by a component.
     * @var bool
     */
    protected(set) static bool $htmxInjected = false;

    /**
     * Injector method that injects the HTMX script into the component / document if it is not already present
     * @return void
     */
    protected static function htmxScript(): void{
        $path = __DIR__ . "/../htmx.min.js";
        $element = new HtmlElement("script");
        $element->contents("Hello");
        $element->attribute(["src" => $path]);
        echo $element->render();
    }

    protected static function injectHtmxScript(): void{
        return static::htmxScript();
    }

}
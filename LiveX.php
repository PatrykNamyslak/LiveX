<?php
namespace LiveX;

use LiveX\Enums\Directive;

abstract class LiveX{
    public static function compile(Component $component): string{
        $preCompiledView = file_get_contents(filename: $component->view());
        $translations = self::translations();
        foreach($translations as $directive => $translation){
            
        }
    }

    /** 
     * Check if htmx was injected
     */
    public static function htmxInjected(){
        return session("liveX.htmxInjected") ?? false;
    }

    public static function render(Component $component){
        $compiledComponent = static::compile(component: $component);
    }


    /**
     * Get all of the translations
     * @return string[]
     */
    final protected static function translations(): array{
        return [
            Directive::OnClick => \LiveX\Translations\OnClick::class,
            Directive::Live => \Livex\Translations\Live::class,
        ];
    }

    /**
     * Get a specific translation
     * @param Directive $directive
     * @return string|null
     */
    final protected static function translation(Directive $directive): string|null{
        return array_search(needle: $directive, haystack: self::translations());
    }


    /**
     * Handle the incoming request to update a component
     * @return void
     */
    final public static function rerender(string $component, JSON $payload, JSON $state): void{}
}
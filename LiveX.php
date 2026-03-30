<?php
namespace LiveX;

use LiveX\Support\Enums\Directive;
use LiveX\Support\Translation;
use LiveX\Support\UncompiledAttribute;
use Probe\Support\JSON;

abstract class LiveX{
    protected Compiler $compiler;


    public static function compile(Component $component): string{
        $preCompiledView = file_get_contents(filename: $component->view());
        $compiledView = $preCompiledView;

        /**
         * `$matches[0]` :: This contains an array of entire matches, i.e: `livex:click="increment"`.
         * `$matches[1]` :: This contains an array of directives/ triggers, i.e `click`.
         * `$matches[2]` :: This contains an array of the action, i.e `increment`.
         */
        $matches = [];
        $liveXRequest = [];
        preg_match_all('/livex:([a-zA-Z0-9_\-]+)="([^"]*)"/', $compiledView, $matches);
        for($i = 0; $i < count($matches[0]); $i++){
            $directive = Directive::tryFrom("livex:{$matches[1][$i]}");
            $liveXRequest[$i] = new UncompiledAttribute(
                attribute: $matches[0][$i], 
                directive: $directive, 
                action: $matches[2][$i], 
            );
            foreach($liveXRequest as $attribute){
                $this->compiler->translate($attribute);
            }
            $translatedRequest = $liveXRequest;

            // $liveXRequest[$i]["attribute"] = $matches[0][$i];
            // $liveXRequest[$i]["directive"] = $matches[1][$i];
            // $liveXRequest[$i]["action"] = $matches[2][$i];
        }
        dd($translatedRequest);
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
     * @return Translation[]
     */
    final protected static function translations(): array{
        return [
            Directive::OnClick->value => \LiveX\Support\Translations\OnClick::class,
            Directive::Live->value => \Livex\Support\Translations\Live::class,
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
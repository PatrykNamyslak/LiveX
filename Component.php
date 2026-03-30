<?php
namespace LiveX;
use LiveX\Support\Traits\Htmx;
use ReflectionClass;

abstract class Component{
    use Htmx;

    final public function boot(): void{
        if(!LiveX::htmxInjected()) static::injectHtmxScript();
    }

    /**
     * Holds the view that will be rendered
     * @return string
     */
    abstract public function view(): string;


    /**
     * Restore the state of a `$component` and rerender it with the updated `$state` after running the desired `$action`.
     * @param string $componentClass The fully qualified component class name, I.E: `\LiveX\Component::class`
     * @param string $action
     * @param array $state
     * @return void
     */
    final protected static function hydrate(string $componentClass, string $action, array $state): Component{
        $c = new ReflectionClass($componentClass);
        // The re-rendered component with the updated state (Post action)
        $rerender = $c->newInstanceArgs($state)->$action();
        return $rerender;
    }
}
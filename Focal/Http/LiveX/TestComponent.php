<?php
namespace Focal\Http\LiveX;

use LiveX\Component;


class TestComponent extends Component{
    public int $count = 0;
    public function increment(): void{
        $this->count++;
    }
    public function view(): string{
        return resource("/views/liveX/testComp.php");
    }
    
    public function render(): void{
        return view(__DIR__ . "/../../resources/views/liveX/testComp.php");
        // parse the component replacing things like livex-on:click="increment" to hx-post="/liveX/?component=compName&method=increment" hx-trigger="click"
        // return app()->liveXComponent("view_name");
    }
}
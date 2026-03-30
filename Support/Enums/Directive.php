<?php
namespace LiveX\Support\Enums;

use LiveX\Support\Translation;
use LiveX\Support\Translations\Live;
use LiveX\Support\Translations\OnClick;


enum Directive: string{
    case OnClick = "livex:click";
    /**
     * Makes a component update in real-time
     */
    case Live = "livex:live";


    /**
     * Translate a directive into an instance of its Translation class
     * @return Translation
     */
    public function translate(): Translation{
        return match($this){
            self::OnClick => new OnClick(),
            self::Live => new Live(),
        };
    }
}
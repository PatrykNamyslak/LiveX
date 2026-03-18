<?php
namespace LiveX\Support\Enums;


enum Directive: string{
    case OnClick = "livex:click";
    /**
     * Makes a component update in real-time
     */
    case Live = "livex:live";
}
<?php
namespace LiveX\Support\Enums;


enum HtmxTrigger: string{
    case Click = 'hx-trigger="click"';
    case OnChange = 'hx-trigger="change"';
}
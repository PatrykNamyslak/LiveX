<?php
namespace LiveX\Support\Enums;


enum HtmxHttpMethod: string{
    case GET = "hx-get";
    case POST = "hx-post";
    case PUT = "hx-put";
    case PATCH = "hx-patch";
    case DELETE = "hx-delete";
}
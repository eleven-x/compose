<?php

/**
 * Compose Middleware
 * @param $middleware
 * @return mixed
 */
function compose($middleware)
{
    $middleware = is_array($middleware) ? $middleware : func_get_args();
    $middleware = array_reverse($middleware);
    return array_reduce($middleware, function ($next, $current) {
        return function ($passable) use ($next, $current) {
            return $current($passable, $next);
        };
    });
}


<?php

use Illuminate\Support\Facades\Request;

/**active menu for sidebar */
function activeMenu($uri = '')
{
    $active = '';
    // if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/*' . $uri) || Request::is($uri)) {
    if (Request::routeIs($uri . '*')) {
        $active = ' active';
    }
    return $active;
}

/**active menu for sidebar */
function activeSubMenu($uris = [])
{
    $active = '';
    if (!empty($uris) && count($uris) > 0) {
        foreach ($uris as $key => $uri) {
            // if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            if (Request::routeIs($uri . '*')) {
                $active = 'active menu-open';
            }
        }
    }

    return $active;
}

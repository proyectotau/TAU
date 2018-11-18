<?php

if (! function_exists('insertTagForDuskTesting')) {
    function insertTagForDuskTesting($selector)
    {
        return (env('APP_ENV', 'production') !== 'production')
        ? "data-dusk=dusk-{$selector}" : '';
    }
}

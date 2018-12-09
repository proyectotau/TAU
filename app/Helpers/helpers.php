<?php

if (! function_exists('insertTagForDuskTesting')) {
    function insertTagForDuskTesting($selector, $actual = true, $expected = false)
    {
        if ($actual === $expected)
            return (env('APP_ENV', 'production') !== 'production')
                    ? "data-dusk=dusk-{$selector}" : '';
    }
}

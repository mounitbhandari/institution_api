<?php
//https://laravel-news.com/creating-helpers
if (! function_exists('get_sql_with_bindings')) {
    function get_sql_with_bindings($query) {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }
}


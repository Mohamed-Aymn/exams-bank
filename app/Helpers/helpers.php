<?php
    if (!function_exists('generateUniqueId')) {
        function generateUniqueId($table, $uniqueAttribute)
        {
            do {
                $key = random_int(0, 2147483647);
                $user = DB::table($table)->where($uniqueAttribute, $key)->first();
            } while ($user !== null);
    
            return $key;
        }
    }
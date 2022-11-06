<?php

if (function_exists('tableName') === false) {
    function tableName(string $name)
    {
        return config('human_resource.db_prefix') . $name;
    }
}

if (function_exists('str') == false) {
    function str(string $string)
    {
        return \Illuminate\Support\Str::of($string);
    }
}

if (!function_exists('human_resourceStatus')) {
    function human_resourceStatus()
    {
        return new \Dainsys\HumanResource\Support\Enums\HumanResourceStatus();
    }
}

if (!function_exists('flashMessage')) {
    function flashMessage(string $message, string $type = 'success')
    {
        $flasher = resolve(\Flasher\Prime\FlasherInterface::class);

        $flasher->option('position', 'bottom-right')->addFlash($type, $message);
    }
}

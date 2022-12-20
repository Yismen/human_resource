<?php

namespace Dainsys\HumanResource;

class HumanResource
{
    public static function registerSuperUsers(array $emails)
    {
        $current = config('human_resource.super_users');

        $new = $current . ',' . join(',', $emails);

        config()->set('human_resource.super_users', $new);
    }
}

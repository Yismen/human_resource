<?php

namespace Dainsys\HumanResource\Http\Controllers;

use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function __invoke()
    {
        return view('human_resource::about', [
            'content' => str(File::get(__DIR__ . '/../../../README.md'))->markdown()
        ])   ;
    }
}

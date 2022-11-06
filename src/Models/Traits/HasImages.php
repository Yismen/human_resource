<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasImages
{
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

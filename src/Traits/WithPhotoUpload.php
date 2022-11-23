<?php

namespace Dainsys\HumanResource\Traits;

use Dainsys\HumanResource\Models\AbstractModel;

trait WithPhotoUpload
{
    protected function updatePhoto(AbstractModel $model, $path = '', $disk = 'public'): string
    {
        if ($this->photo) {
            $name = str($model->getMorphClass())->afterLast('\\', '')->studly() . "-{$model->id}.{$this->photo->guessExtension()}";
            $path = $this->photo->storeAs($path, $name, $disk);
            return $path;
        }

        return '';
    }
}

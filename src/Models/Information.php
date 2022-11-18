<?php

namespace Dainsys\HumanResource\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Dainsys\HumanResource\Database\Factories\InformationFactory;

class Information extends AbstractModel
{
    protected $fillable = ['phone', 'email', 'photo_url', 'address', 'company_id', 'informationable_id', 'informationable_type'];

    protected static function newFactory(): InformationFactory
    {
        return InformationFactory::new();
    }

    public function getTable(): string
    {
        return tableName('informations');
    }

    public function informationable(): MorphTo
    {
        return $this->morphTo();
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'informationable');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'informationable');
    }

    public function ars(): BelongsTo
    {
        return $this->belongsTo(Ars::class, 'informationable');
    }

    public function afp(): BelongsTo
    {
        return $this->belongsTo(Afp::class, 'informationable');
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'informationable');
    }
}

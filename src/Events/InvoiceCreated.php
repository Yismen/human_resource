<?php

namespace Dainsys\HumanResource\Events;

use Dainsys\HumanResource\Models\HumanResource;
use Illuminate\Queue\SerializesModels;
use Dainsys\HumanResource\Models\HumanResourceType;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class HumanResourceCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public HumanResource $human_resource;

    public function __construct(HumanResource $human_resource)
    {
        $human_resourceType = HumanResourceType::findOrFail($human_resource->human_resource_type_id);

        $sequence = ++$human_resourceType->sequence;

        $human_resource->update([
            'reference' => $sequence
        ]);

        $human_resourceType->updateQuietly([
            'sequence' => $sequence
        ]);
    }
}

<?php

namespace App\Transformers\Requests;

use App\Transformers\Transformer;
use App\Models\Admin\CancellationReason;

class CancellationReasonsTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */


    /**
     * A Fractal transformer.
     *
     * @param CancellationReason $reason
     * @return array
     */
    public function transform(CancellationReason $reason)
    {
        return [
            'id' => $reason->id,
            'user_type' => $reason->user_type,
            'arrival_status' => $reason->arrival_status,
            'reason' => $reason->reason,
            'reason_ar' => $reason->reason_ar,

        ];
    }
}

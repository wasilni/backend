<?php

namespace App\Base\Serializers;

use League\Fractal\Serializer\DataArraySerializer;

class CustomDataArraySerializer extends DataArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection(?string $resourceKey, array $data): array
    {
        return $resourceKey === false ? $data : compact('data');
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function item(?string $resourceKey, array $data): array 
    {
        return $resourceKey === false ? $data : compact('data');
    }

    /**
     * Serialize null resource.
     *
     * @return array
     */
    public function null(): ?array
    {
     return ['data' => []];
        // return ;
    }
}

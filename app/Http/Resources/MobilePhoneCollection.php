<?php

/**
 * MobilePhoneCollection.php
 *
 * Resource Collection for MobilePhone.
 *
 * Defines the structure of the JSON data returned by the API when
 * listing mobile phones, including additional metadata.
 *
 * @author Santiago Sabogal
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MobilePhoneCollection extends ResourceCollection
{

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($phone) {
                return [
                    'name' => $phone->getName(),
                    'brand' => $phone->getBrand(),
                    'price' => $phone->getPrice(),
                ];
            }),
        ];
    }
}

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
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($phone) {
                return [
                    'id' => $phone->getId(),
                    'name' => $phone->getName(),
                    'brand' => $phone->getBrand(),
                    'price' => $phone->getPrice(),
                    'price_formatted' => $phone->getPriceFormatted(),
                    'stock' => $phone->getStock(),
                    'photo_url' => $phone->getPhotoUrl(),
                    'created_at' => $phone->getCreatedAt(),
                    'updated_at' => $phone->getUpdatedAt(),
                ];
            }),
            'additionalData' => [
                'storeName' => 'Mega Store',
                'storeProductsLink' => url('/mobile-phones'),
                'totalItems' => $this->collection->count(),
            ],
        ];
    }
}

<?php

namespace Database\Factories;

class ProductData
{
    public static function getBestSellers()
    {
        return [
            [
                'name' => 'Bitter Peach',
                'category' => 'Unisex',
                'price' => 2500000,
                'image' => 'images/products/bitterpeach.jpg'
            ],
            [
                'name' => 'Lost Cherry',
                'category' => 'Wanita',
                'price' => 2800000,
                'image' => 'images/products/lostcherry.jpg'
            ],
            [
                'name' => 'Oud Wood',
                'category' => 'Pria',
                'price' => 3200000,
                'image' => 'images/products/lostcherry2.jpg'
            ],
            [
                'name' => 'Tobacco Vanille',
                'category' => 'Unisex',
                'price' => 2900000,
                'image' => 'images/products/thumbnail.jpg'
            ],
        ];
    }
}

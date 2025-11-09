<?php

/**
 * validation.php
 *
 * English validation messages.
 *
 * @author Miguel Arcila
 */

return [

    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute must be a string.',
    'email' => 'The :attribute must be a valid email address.',
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
        'numeric' => 'The :attribute may not be greater than :max.',
    ],
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
        'numeric' => 'The :attribute must be at least :min.',
    ],
    'integer' => 'The :attribute must be an integer.',
    'numeric' => 'The :attribute must be a number.',
    'boolean' => 'The :attribute field must be true or false.',
    'date' => 'The :attribute is not a valid date.',
    'in' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute does not exist.',
    'unique' => 'The :attribute has already been taken.',
    'nullable' => 'The :attribute field may be null.',

    'custom' => [
        // User
        'name' => [
            'required' => 'The name is required.',
            'string' => 'The name must be a string.',
            'max' => 'The name may not be greater than :max characters.',
        ],
        'email' => [
            'required' => 'The email is required.',
            'email' => 'The email must be a valid email address.',
            'max' => 'The email may not be greater than :max characters.',
            'unique' => 'This email is already registered.',
        ],
        'password' => [
            'required' => 'The password is required.',
            'string' => 'The password must be a string.',
            'min' => 'The password must be at least :min characters.',
        ],
        'staff' => [
            'boolean' => 'The staff field must be true or false.',
        ],
        'phone' => [
            'string' => 'The phone must be a string.',
            'max' => 'The phone may not be greater than :max characters.',
        ],
        'address' => [
            'string' => 'The address must be a string.',
            'max' => 'The address may not be greater than :max characters.',
        ],
        'balance' => [
            'numeric' => 'The balance must be a number.',
            'min' => 'The balance may not be negative.',
            'max' => 'The balance may not be greater than :max.',
        ],

        // Order
        'date' => [
            'required' => 'The order date is required.',
            'date' => 'The date must be a valid format.',
        ],
        'status' => [
            'required' => 'The status is required.',
            'in' => 'The status must be: :values.',
        ],
        'total' => [
            'required' => 'The total is required.',
            'integer' => 'The total must be an integer.',
            'min' => 'The total may not be negative.',
        ],
        'user_id' => [
            'required' => 'The user is required.',
            'integer' => 'The user must be a numeric identifier.',
            'exists' => 'The selected user does not exist.',
        ],

        // MobilePhone
        'photo_url' => [
            'string' => 'The photo URL must be a string.',
            'max' => 'The photo URL may not be greater than :max characters.',
        ],
        'brand' => [
            'required' => 'The brand is required.',
            'string' => 'The brand must be a string.',
            'max' => 'The brand may not be greater than :max characters.',
        ],
        'price' => [
            'required' => 'The price is required.',
            'integer' => 'The price must be an integer.',
            'min' => 'The price may not be negative.',
        ],
        'stock' => [
            'required' => 'The stock is required.',
            'integer' => 'The stock must be an integer.',
            'min' => 'The stock may not be negative.',
        ],

        // OrderItem & Cart
        'mobile_phone_id' => [
            'required' => 'The product is required.',
            'integer' => 'The product must be a numeric identifier.',
            'exists' => 'The selected product does not exist.',
        ],
        'quantity' => [
            'required' => 'The quantity is required.',
            'integer' => 'The quantity must be an integer.',
            'min' => 'The quantity must be at least :min.',
        ],
        'order_id' => [
            'required' => 'The order is required.',
            'integer' => 'The order must be a numeric identifier.',
            'exists' => 'The selected order does not exist.',
        ],

        // Review
        'rating' => [
            'required' => 'The rating is required.',
            'integer' => 'The rating must be an integer.',
            'min' => 'The minimum rating is :min.',
            'max' => 'The maximum rating is :max.',
        ],
        'comments' => [
            'string' => 'The comments must be a string.',
            'max' => 'The comments may not be greater than :max characters.',
        ],

        // Specification
        'model' => [
            'required' => 'The model is required.',
            'string' => 'The model must be a string.',
            'max' => 'The model may not be greater than :max characters.',
        ],
        'processor' => [
            'required' => 'The processor is required.',
            'string' => 'The processor must be a string.',
            'max' => 'The processor may not be greater than :max characters.',
        ],
        'battery' => [
            'required' => 'The battery is required.',
            'integer' => 'The battery must be an integer (mAh).',
            'min' => 'The battery may not be negative.',
        ],
        'screen_size' => [
            'required' => 'The screen size is required.',
            'numeric' => 'The screen size must be numeric.',
            'min' => 'The screen size may not be negative.',
        ],
        'screen_tech' => [
            'required' => 'The screen technology is required.',
            'string' => 'The screen technology must be a string.',
            'max' => 'The screen technology may not be greater than :max characters.',
        ],
        'ram' => [
            'required' => 'The RAM is required.',
            'integer' => 'The RAM must be an integer (GB).',
            'min' => 'The RAM may not be negative.',
        ],
        'storage' => [
            'required' => 'The storage is required.',
            'integer' => 'The storage must be an integer (GB).',
            'min' => 'The storage may not be negative.',
        ],
        'camera_specs' => [
            'string' => 'The camera specifications must be a string.',
            'max' => 'The camera specifications may not be greater than :max characters.',
        ],
        'color' => [
            'required' => 'The color is required.',
            'string' => 'The color must be a string.',
            'max' => 'The color may not be greater than :max characters.',
        ],
    ],

    'attributes' => [
        'name' => 'name',
        'email' => 'email',
        'password' => 'password',
        'balance' => 'balance',
        'staff' => 'staff',
        'phone' => 'phone',
        'address' => 'address',
        'date' => 'date',
        'status' => 'status',
        'total' => 'total',
        'user_id' => 'user',
        'photo_url' => 'photo',
        'brand' => 'brand',
        'price' => 'price',
        'stock' => 'stock',
        'mobile_phone_id' => 'product',
        'quantity' => 'quantity',
        'order_id' => 'order',
        'rating' => 'rating',
        'comments' => 'comments',
        'model' => 'model',
        'processor' => 'processor',
        'battery' => 'battery',
        'screen_size' => 'screen size',
        'screen_tech' => 'screen technology',
        'ram' => 'RAM',
        'storage' => 'storage',
        'camera_specs' => 'camera specifications',
        'color' => 'color',
    ],
];

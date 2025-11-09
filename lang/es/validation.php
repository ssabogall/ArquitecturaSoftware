<?php

/**
 * validation.php
 *
 * Custom validation messages in Spanish
 *
 * @author Copilot Assistant
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser texto.',
    'email' => 'El campo :attribute debe ser un correo electrónico válido.',
    'max' => [
        'string' => 'El campo :attribute no puede superar los :max caracteres.',
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
    ],
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
        'numeric' => 'El campo :attribute debe ser al menos :min.',
    ],
    'integer' => 'El campo :attribute debe ser un número entero.',
    'numeric' => 'El campo :attribute debe ser numérico.',
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'date' => 'El campo :attribute debe ser una fecha válida.',
    'in' => 'El campo :attribute seleccionado no es válido.',
    'exists' => 'El :attribute seleccionado no existe.',
    'unique' => 'El :attribute ya está en uso.',
    'nullable' => 'El campo :attribute puede estar vacío.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        // User
        'name' => [
            'required' => 'El nombre es obligatorio.',
            'string' => 'El nombre debe ser texto.',
            'max' => 'El nombre no puede superar los :max caracteres.',
        ],
        'email' => [
            'required' => 'El correo electrónico es obligatorio.',
            'email' => 'El correo electrónico debe ser válido.',
            'max' => 'El correo electrónico no puede superar los :max caracteres.',
            'unique' => 'Este correo electrónico ya está registrado.',
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria.',
            'string' => 'La contraseña debe ser texto.',
            'min' => 'La contraseña debe tener al menos :min caracteres.',
        ],
        'staff' => [
            'boolean' => 'El campo staff debe ser verdadero o falso.',
        ],
        'phone' => [
            'string' => 'El teléfono debe ser texto.',
            'max' => 'El teléfono no puede superar los :max caracteres.',
        ],
        'address' => [
            'string' => 'La dirección debe ser texto.',
            'max' => 'La dirección no puede superar los :max caracteres.',
        ],

        // Order
        'date' => [
            'required' => 'La fecha de la orden es obligatoria.',
            'date' => 'La fecha debe tener un formato válido.',
        ],
        'status' => [
            'required' => 'El estado es obligatorio.',
            'in' => 'El estado debe ser: :values.',
        ],
        'total' => [
            'required' => 'El total es obligatorio.',
            'integer' => 'El total debe ser un número entero.',
            'min' => 'El total no puede ser negativo.',
        ],
        'user_id' => [
            'required' => 'El usuario es obligatorio.',
            'integer' => 'El usuario debe ser un identificador numérico.',
            'exists' => 'El usuario seleccionado no existe.',
        ],

        // MobilePhone
        'photo_url' => [
            'string' => 'La URL de la foto debe ser texto.',
            'max' => 'La URL de la foto no puede superar los :max caracteres.',
        ],
        'brand' => [
            'required' => 'La marca es obligatoria.',
            'string' => 'La marca debe ser texto.',
            'max' => 'La marca no puede superar los :max caracteres.',
        ],
        'price' => [
            'required' => 'El precio es obligatorio.',
            'integer' => 'El precio debe ser un número entero.',
            'min' => 'El precio no puede ser negativo.',
        ],
        'stock' => [
            'required' => 'El stock es obligatorio.',
            'integer' => 'El stock debe ser un número entero.',
            'min' => 'El stock no puede ser negativo.',
        ],

        // OrderItem & Cart
        'mobile_phone_id' => [
            'required' => 'El producto es obligatorio.',
            'integer' => 'El producto debe ser un identificador numérico.',
            'exists' => 'El producto seleccionado no existe.',
        ],
        'quantity' => [
            'required' => 'La cantidad es obligatoria.',
            'integer' => 'La cantidad debe ser un número entero.',
            'min' => 'La cantidad debe ser al menos :min.',
        ],
        'order_id' => [
            'required' => 'La orden es obligatoria.',
            'integer' => 'La orden debe ser un identificador numérico.',
            'exists' => 'La orden seleccionada no existe.',
        ],

        // Review
        'rating' => [
            'required' => 'La calificación es obligatoria.',
            'integer' => 'La calificación debe ser un número entero.',
            'min' => 'La calificación mínima es :min.',
            'max' => 'La calificación máxima es :max.',
        ],
        'comments' => [
            'string' => 'Los comentarios deben ser texto.',
            'max' => 'Los comentarios no pueden superar los :max caracteres.',
        ],

        // Specification
        'model' => [
            'required' => 'El modelo es obligatorio.',
            'string' => 'El modelo debe ser texto.',
            'max' => 'El modelo no puede superar los :max caracteres.',
        ],
        'processor' => [
            'required' => 'El procesador es obligatorio.',
            'string' => 'El procesador debe ser texto.',
            'max' => 'El procesador no puede superar los :max caracteres.',
        ],
        'battery' => [
            'required' => 'La batería es obligatoria.',
            'integer' => 'La batería debe ser un número entero (mAh).',
            'min' => 'La batería no puede ser negativa.',
        ],
        'screen_size' => [
            'required' => 'El tamaño de pantalla es obligatorio.',
            'numeric' => 'El tamaño de pantalla debe ser numérico.',
            'min' => 'El tamaño de pantalla no puede ser negativo.',
        ],
        'screen_tech' => [
            'required' => 'La tecnología de pantalla es obligatoria.',
            'string' => 'La tecnología de pantalla debe ser texto.',
            'max' => 'La tecnología de pantalla no puede superar los :max caracteres.',
        ],
        'ram' => [
            'required' => 'La RAM es obligatoria.',
            'integer' => 'La RAM debe ser un número entero (GB).',
            'min' => 'La RAM no puede ser negativa.',
        ],
        'storage' => [
            'required' => 'El almacenamiento es obligatorio.',
            'integer' => 'El almacenamiento debe ser un número entero (GB).',
            'min' => 'El almacenamiento no puede ser negativo.',
        ],
        'camera_specs' => [
            'string' => 'Las especificaciones de cámara deben ser texto.',
            'max' => 'Las especificaciones de cámara no pueden superar los :max caracteres.',
        ],
        'color' => [
            'required' => 'El color es obligatorio.',
            'string' => 'El color debe ser texto.',
            'max' => 'El color no puede superar los :max caracteres.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'staff' => 'staff',
        'phone' => 'teléfono',
        'address' => 'dirección',
        'date' => 'fecha',
        'status' => 'estado',
        'total' => 'total',
        'user_id' => 'usuario',
        'photo_url' => 'foto',
        'brand' => 'marca',
        'price' => 'precio',
        'stock' => 'stock',
        'mobile_phone_id' => 'producto',
        'quantity' => 'cantidad',
        'order_id' => 'orden',
        'rating' => 'calificación',
        'comments' => 'comentarios',
        'model' => 'modelo',
        'processor' => 'procesador',
        'battery' => 'batería',
        'screen_size' => 'tamaño de pantalla',
        'screen_tech' => 'tecnología de pantalla',
        'ram' => 'RAM',
        'storage' => 'almacenamiento',
        'camera_specs' => 'especificaciones de cámara',
        'color' => 'color',
    ],
];

<?php

return [
    'pagination' => [
        'previous' => '&laquo; Anterior',
        'next' => 'Siguiente &raquo;',
    ],

    'auth' => [
        'failed' => 'Estas credenciales no coinciden con nuestros registros.',
        'password' => 'La contraseña proporcionada es incorrecta.',
        'throttle' => 'Demasiados intentos de acceso. Por favor inténtelo de nuevo en :seconds segundos.',
    ],

    'validation' => [
        'required' => 'El campo :attribute es obligatorio.',
        'email' => 'El campo :attribute debe ser una dirección de correo válida.',
        'min' => [
            'numeric' => 'El campo :attribute debe ser al menos :min.',
            'file' => 'El campo :attribute debe tener al menos :min kilobytes.',
            'string' => 'El campo :attribute debe tener al menos :min caracteres.',
            'array' => 'El campo :attribute debe tener al menos :min elementos.',
        ],
        'max' => [
            'numeric' => 'El campo :attribute no debe ser mayor que :max.',
            'file' => 'El campo :attribute no debe ser mayor que :max kilobytes.',
            'string' => 'El campo :attribute no debe ser mayor que :max caracteres.',
            'array' => 'El campo :attribute no debe tener más de :max elementos.',
        ],
        'confirmed' => 'La confirmación de :attribute no coincide.',
        'unique' => 'El valor del campo :attribute ya está en uso.',
    ],

    'passwords' => [
        'reset' => 'Su contraseña ha sido restablecida.',
        'sent' => 'Le hemos enviado por correo electrónico el enlace para restablecer su contraseña.',
        'throttled' => 'Por favor espere antes de intentar de nuevo.',
        'token' => 'El token de restablecimiento de contraseña es inválido.',
        'user' => "No podemos encontrar un usuario con ese correo electrónico.",
    ],
];
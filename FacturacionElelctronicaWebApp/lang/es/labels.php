<?php

return [

    'empresas' => [
        'numero_identificacion' => 'Número de identificación',
        'razon_social' => 'Razón social'
    ],
    'establecimientos' => [
        'descripcion' => 'Descripción',
        'codigo_institucion' => 'Código de institución',
        'direccion' => 'Dirección',
        'empresa' => 'Empresa',
        'tipo_comprobante' => 'Tipo de comprobante',
        'electronico' => 'Electrónico',
        'puntos_emision' => 'Puntos de emisión'
    ],
    'clientes' => [
        'tipo_identificacion' => 'Tipo de identificación',
        'correos' => 'Correos electrónicos',
        'active' => '¿Activo?'
    ],
    'items' => [
        'codigo' => 'Código',
        'categoria' => 'Categoría',
        'descripcion' => 'Descripción'
    ],
    'usuarios' => [
        'nombre' => 'Nombre',
        'password' => 'Contraseña',
        'password_confirmation' => 'Confirmación de contraseña',
        'foto_perfil' => 'Foto de perfil'
    ],
    'tarifas' => [
        'impuesto' => 'Impuesto',
        'codigo_institucion' => 'Código de institución',
        'descripcion' => 'Descripción'
    ],
    'comprobantes' => [
        'informacion' => 'Información',
        'informacion_adicional' => 'Información adicional',
        'cabecera' => [
            'punto_emision' => 'Punto de emisión',
            'fecha_emision' => 'Fecha de emisión',
            'cliente' => 'Cliente',
            'numero_documento' => '# Documento'
        ],
        'detalles' => [
            'item' => 'Item'
        ],
        'totales' => [
            'subtotal_si' => 'Subtotal sin impuestos'
        ]
    ]
];

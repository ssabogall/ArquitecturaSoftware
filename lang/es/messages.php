<?php

/**
 * messages.php
 *
 * Resources for language usage in spanish.
 *
 * @author Alejandro Carmona
 * @author Miguel Angel Arcila
 */

return [
    // --- General UI ---
    'app_title' => 'CellHub',
    'home' => 'Inicio',
    'dashboard' => 'Panel de control',
    'profile' => 'Perfil',
    'settings' => 'Configuración',
    'about' => 'Nosotros',
    'about_us' => 'Sobre Nosotros',
    'footer' => 'Pie de página',
    'copyright' => 'Derechos de autor',
    'rights_reserved' => 'Todos los derechos reservados',
    'toggle_navigation' => 'Cambiar navegación',

    // --- Auth ---
    'login' => 'Iniciar sesión',
    'register' => 'Registrarse',
    'logout' => 'Cerrar sesión',
    'my_profile' => 'Mi perfil',
    'my_orders' => 'Mis órdenes',
    'email' => 'Correo electrónico',
    'password' => 'Contraseña',
    'confirm_password' => 'Confirmar contraseña',
    'remember_me' => 'Recordarme',
    'forgot_password' => '¿Olvidaste tu contraseña?',
    'hello_name' => 'Hola, :name',

    // --- Forms ---
    'submit' => 'Enviar',
    'save' => 'Guardar',
    'cancel' => 'Cancelar',
    'delete' => 'Eliminar',
    'edit' => 'Editar',
    'create' => 'Crear',
    'update' => 'Actualizar',
    'back' => 'Volver',
    'name' => 'Nombre',
    'description' => 'Descripción',
    'address' => 'Dirección',
    'phone' => 'Teléfono',
    'staff' => 'Staff',
    'optional' => 'Opcional',
    'created_at' => 'Creado el',
    'updated_at' => 'Actualizado el',
    'id' => 'ID',
    'actions' => 'Acciones',
    'quantity' => 'Cantidad',
    'total' => 'Total',
    'date' => 'Fecha',
    'not_provided' => '—',
    'user' => 'Usuario',
    'items' => 'Artículos',

    // --- Status and messages ---
    'no_results' => 'No se encontraron resultados',
    'are_you_sure' => '¿Estás seguro?',
    'yes' => 'Sí',
    'no' => 'No',
    'success' => 'Éxito',
    'error' => 'Error',
    'warning' => 'Advertencia',
    'info' => 'Información',
    'or' => 'o',

    // --- Welcome page ---
    'welcome' => 'Bienvenido',
    'welcome_website' => 'Bienvenido a nuestro sitio web',
    'glad_you_are_here' => 'Nos alegra que estés aquí',
    'home_headline' => 'Encuentra tu próximo celular',
    'home_subheadline' => 'Nuestros productos mejor valorados',

    // --- Passwords ---
    'reset_password' => 'Restablecer contraseña',
    'send_password_reset_link' => 'Enviar enlace para restablecer contraseña',
    'confirm_password_before_continue' => 'Por favor confirma tu contraseña antes de continuar.',

    // --- Email verification ---
    'verify_email' => 'Verifica tu dirección de correo electrónico',
    'verification_link_sent' => 'Se ha enviado un nuevo enlace de verificación a tu correo electrónico.',
    'check_email_for_link' => 'Antes de continuar, revisa tu correo electrónico para el enlace de verificación.',
    'did_not_receive_email' => 'Si no recibiste el correo',
    'request_another_link' => 'haz clic aquí para solicitar otro',

    // --- Admin ---
    'admin_panel' => 'Panel de administración',
    'users' => 'Usuarios',
    'orders' => 'Órdenes',
    'products' => 'Productos',
    'specifications' => 'Especificaciones',
    'reviews' => 'Reseñas',
    'view' => 'Ver',
    'pending' => 'pendiente',
    'paid' => 'pagada',
    'shipped' => 'enviada',
    'cancelled' => 'cancelada',
    'approved' => 'aprobada',
    'rejected' => 'rechazada',
    'status' => 'Estado',
    'rating' => 'Calificación',
    'comments' => 'Comentarios',
    'average_rating' => 'Calificación promedio',
    'based_on_reviews' => 'basado en :count reseñas',
    'out_of_max' => 'sobre :max',
    'approve' => 'Aprobar',
    'reject' => 'Rechazar',

    // --- Admin - Products ---
    'new_product' => 'Nuevo producto',
    'edit_product' => 'Editar producto',
    'product_details' => 'Detalle de producto',
    'product_created' => 'Producto creado correctamente.',
    'product_updated' => 'Producto actualizado correctamente.',
    'product_deleted' => 'Producto eliminado correctamente.',
    'brand' => 'Marca',
    'price' => 'Precio',
    'stock' => 'Stock',
    'photo_url' => 'URL de la foto',
    'photo' => 'Foto',
    'current' => 'Actual',
    'currency_symbol' => '$',
    'cart' => 'Carrito',
    'checkout' => 'Finalizar compra',
    'add_to_cart' => 'Añadir al carrito',
    'added_to_cart' => 'Producto añadido al carrito.',
    'cart_updated' => 'Carrito actualizado.',
    'item_removed' => 'Producto eliminado del carrito.',
    'last_units' => 'Últimas :count unidades',
    'order_created' => 'Tu orden fue creada correctamente.',
    'order_cancelled' => 'La orden fue cancelada.',
    'invalid_action' => 'Acción no permitida para el estado actual.',
    'return' => 'Devolver',
    'address_required_for_checkout' => 'Necesitas registrar una dirección de entrega antes de finalizar la compra.',
    'go_to_profile_to_update' => 'Ve a tu perfil para actualizar tu información.',
    'invoice' => 'Factura',
    'invoice_number' => 'N° de factura',
    'view_pdf' => 'Ver PDF',
    'download_pdf' => 'Descargar PDF',

    // --- Admin - Reviews ---
    'pending_reviews_widget' => ':count reseñas pendientes por aprobación',
    'review_approved' => 'Reseña aprobada correctamente.',
    'review_rejected' => 'Reseña rechazada.',
    'review_submitted_pending' => 'Tu reseña fue enviada y será publicada cuando sea aprobada.',
    'review_submit_info' => 'Tu reseña quedará pendiente de aprobación antes de publicarse.',
    'to_review_info' => 'para dejar una reseña.',
    'leave_review' => 'Dejar una reseña',
    'search' => 'Buscar',
    'search_placeholder' => 'Buscar por nombre o marca',
    'clear' => 'Limpiar',

    // --- Admin - Specifications ---
    'spec_details' => 'Detalle de especificación',
    'new_spec' => 'Nueva especificación',
    'edit_spec' => 'Editar especificación',
    'spec_created' => 'Especificación creada correctamente.',
    'spec_updated' => 'Especificación actualizada correctamente.',
    'spec_deleted' => 'Especificación eliminada correctamente.',
    'model' => 'Modelo',
    'processor' => 'Procesador',
    'battery' => 'Batería (mAh)',
    'screen_size' => 'Tamaño de pantalla (\")',
    'screen_tech' => 'Tecnología de pantalla',
    'ram' => 'RAM (GB)',
    'storage' => 'Almacenamiento (GB)',
    'camera_specs' => 'Cámaras',
    'color' => 'Color',
    'select' => 'Seleccionar',

    // --- Admin - Users ---
    'new_user' => 'Nuevo usuario',
    'edit_user' => 'Editar usuario',
    'user_details' => 'Detalle de usuario',
    'user_created' => 'Usuario creado correctamente.',
    'user_updated' => 'Usuario actualizado correctamente.',
    'user_deleted' => 'Usuario eliminado correctamente.',

    // --- User profile ---
    'my_account' => 'Mi cuenta',
    'profile_updated' => 'Perfil actualizado correctamente.',
    'balance' => 'Saldo',
];

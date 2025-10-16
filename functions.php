<?php 

function hola_mundo(){
    echo "hola mundo";
}

function jerotheme_menu_register(){
    register_nav_menus(array(
        'main-menu' => 'Menú Principal',
        'footer-menu' => 'Menú de Pie de Página',
        'lateral-menu' => 'Menú Lateral'

    ));
    #wp_terms se registran los menus que hemos creado
}

add_action('after_setup_theme','jerotheme_menu_register');

function jerotheme_scripts_styles(){
    wp_enqueue_style('jerotheme-style', get_stylesheet_uri(), array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'jerotheme_scripts_styles');





/**
 * 2) Encolar media uploader y JS solo en la pantalla de Menús
 */
function jerotheme_menu_admin_assets($hook) {
    if ($hook !== 'nav-menus.php') return;

    // Carga el frame de la librería de medios
    wp_enqueue_media();

    // JS inline sencillo para el selector por ítem
    $js = <<<JS
(function($){
    function bindImageField(container){
        container.on('click', '.jeromenu-image-select', function(e){
            e.preventDefault();
            var wrap = $(this).closest('.jeromenu-image-field');
            var input = wrap.find('.jeromenu-image-id');
            var preview = wrap.find('.jeromenu-image-preview');
            var frame = wp.media({
                title: 'Selecciona una imagen del menú',
                multiple: false,
                library: { type: 'image' }
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                input.val(attachment.id);
                preview.html('<img src="'+attachment.sizes.thumbnail.url+'" style="max-width:80px;height:auto;border-radius:6px;" />');
                wrap.find('.jeromenu-image-remove').show();
            });
            frame.open();
        });

        container.on('click', '.jeromenu-image-remove', function(e){
            e.preventDefault();
            var wrap = $(this).closest('.jeromenu-image-field');
            wrap.find('.jeromenu-image-id').val('');
            wrap.find('.jeromenu-image-preview').empty();
            $(this).hide();
        });
    }

    $(document).ready(function(){
        // Inicial para ítems presentes
        bindImageField($('#menu-to-edit'));

        // Cuando se abre/duplica un ítem vía AJAX
        $(document).on('menu-item-added menu-item-updated', function(e, menuItem){
            bindImageField($(menuItem));
        });
    });
})(jQuery);
JS;
    wp_add_inline_script('jquery', $js);
}
add_action('admin_enqueue_scripts', 'jerotheme_menu_admin_assets');


/**
 * 3) Campo personalizado en cada ítem del menú (admin)
 *    Hook disponible desde WP 5.4
 */
function jerotheme_menu_item_custom_fields($item_id, $item) {
    $image_id = get_post_meta($item_id, '_menu_image_id', true);
    $thumb    = $image_id ? wp_get_attachment_image($image_id, 'thumbnail', false, array('style'=>'max-width:80px;height:auto;border-radius:6px;')) : '';
    ?>
    <div class="field-jeromenu-image description-wide jeromenu-image-field" style="margin-top:10px;">
        <span class="description"><?php esc_html_e('Imagen del ítem (opcional):', 'jerotheme'); ?></span>
        <div class="jeromenu-image-preview" style="margin:6px 0;"><?php echo $thumb ?: ''; ?></div>
        <input type="hidden" class="jeromenu-image-id" name="menu_image_id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($image_id); ?>" />
        <p class="description">
            <a href="#" class="button jeromenu-image-select"><?php esc_html_e('Seleccionar imagen', 'jerotheme'); ?></a>
            <a href="#" class="button jeromenu-image-remove" <?php if(!$image_id) echo 'style="display:none"'; ?>><?php esc_html_e('Quitar imagen', 'jerotheme'); ?></a>
        </p>
    </div>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'jerotheme_menu_item_custom_fields', 10, 2);


/**
 * 4) Guardar el meta al actualizar el menú
 */
function jerotheme_save_menu_item_image($menu_id, $menu_item_db_id, $args) {
    if (isset($_POST['menu_image_id'][$menu_item_db_id])) {
        $new = (int) $_POST['menu_image_id'][$menu_item_db_id];
        if ($new) {
            update_post_meta($menu_item_db_id, '_menu_image_id', $new);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_image_id');
        }
    }
}
add_action('wp_update_nav_menu_item', 'jerotheme_save_menu_item_image', 10, 3);


/**
 * 5) Pintar la imagen en el frontend dentro del <a> del menú
 *    Puedes ajustar: tamaño, clases, posición, marcado
 */
function jerotheme_menu_item_output($item_output, $item, $depth, $args) {
    $image_id = get_post_meta($item->ID, '_menu_image_id', true);
    if (!$image_id) return $item_output;

    // Tamaño de imagen: usa 'thumbnail' o define uno propio
    $img_html = wp_get_attachment_image($image_id, 'thumbnail', false, array(
        'class' => 'menu-item-image',
        'loading' => 'lazy',
        'decoding'=> 'async',
        'style' => 'width:24px;height:24px;object-fit:cover;border-radius:4px;margin-right:8px;vertical-align:middle;'
    ));
    if (!$img_html) return $item_output;

    // Inserta la imagen justo después de la etiqueta <a> de apertura
    // Ej.: <a ...>IMG AQUÍ TÍTULO</a>
    $item_output = preg_replace(
        '/(<a[^>]*>)/',
        '$1' . $img_html,
        $item_output,
        1
    );

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'jerotheme_menu_item_output', 10, 4);

?>
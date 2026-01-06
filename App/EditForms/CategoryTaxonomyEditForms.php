<?php
namespace TAI\App\EditForms;

use TAI\App\Core\Traits\AdminMessageTrait;
use WP_User_Query;

( defined( 'ABSPATH' ) ) || exit;

class CategoryTaxonomyEditForms {

    use AdminMessageTrait;

    public function __construct() {

         add_action('category_edit_form_fields', [ $this, 'add_category_image_field_edit' ], 10, 2 );
        add_action('edited_category', [ $this, 'save_category_image_meta' ], 10, 2 );
    }



function add_category_image_field_edit( $term, $taxonomy ) {

    $image_id = get_term_meta( $term->term_id, 'category_image_id', true );
    $image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : '';
    ?>
    <tr class="form-field term-image-wrap">
        <th scope="row">
            <label for="category-image">تصویر دسته‌بندی</label>
        </th>
        <td>
            <input type="hidden" id="category-image-id" name="category_image_id" value="<?php echo esc_attr( $image_id ); ?>">
            <div id="category-image-preview">
                <?php if ( $image_url ) : ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" style="max-width:150px;">
                <?php endif; ?>
            </div>
            <button type="button" class="button upload-category-image">انتخاب تصویر</button>
            <button type="button" class="button remove-category-image">حذف</button>
        </td>
    </tr>
    <?php
}


function save_category_image_meta( $term_id, $tt_id ) {

    if ( isset( $_POST['category_image_id'] ) ) {
        update_term_meta(
            $term_id,
            'category_image_id',
            intval( $_POST['category_image_id'] )
        );
    }
}





}

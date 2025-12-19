<?php
namespace TAI\App\Services\Panel;

use Exception;
use TAI\App\Core\SendSMS;
use TAI\App\Services\Service;
use WP_Query;
use WP_User_Query;

( defined( 'ABSPATH' ) ) || exit;

class PanelServices extends Service {

    public function __construct() {
    }

    public function dashboard() {

        $args = array(
            'meta_key'   => 'user_leader',
            'meta_value' => get_current_user_id(),
        );

        $user_query = new WP_User_Query( $args );

        $users = $user_query->get_results();

        if ( ! empty( $users ) ) {
            foreach ( $users as $user ) {
                $user_data[  ] = array(
                    'username'     => $user->user_login,
                    'name'         => get_user_meta( $user->ID, "fullName", true ),
                    'nationalCode' => get_user_meta( $user->ID, "nationalCode", true ),
                );
            }
        }

        return array(

            'groupName'    => get_user_meta( get_current_user_id(), "groupName", true ),
            'fullName'     => get_user_meta( get_current_user_id(), "fullName", true ),
            'parent'       => get_user_meta( get_current_user_id(), "parent", true ),
            'nationalCode' => get_user_meta( get_current_user_id(), "nationalCode", true ),
            'birthday'     => get_user_meta( get_current_user_id(), "birthday", true ),
            'edu'          => get_user_meta( get_current_user_id(), "edu", true ),
            'address'      => get_user_meta( get_current_user_id(), "address", true ),
            'addressPost'  => get_user_meta( get_current_user_id(), "addressPost", true ),
            'teems'        => $user_data ?? array(),

        );
    }

    public function update( $request ) {

        $fullNameOld = get_user_meta( get_current_user_id(), "fullName", true );
        $fullName    = sanitize_text_field( $request[ 'fullName' ] );

        if ( empty( $fullNameOld ) && ! empty( $fullName ) ) {
            SendSMS::register( "test", get_current_user_id() );
        }

        if ( ! empty( $fullNameOld ) && empty( $fullName ) ) {
            $fullName = $fullNameOld;
        }

        update_user_meta( get_current_user_id(), "groupName", sanitize_text_field( $request[ 'groupName' ] ) );
        update_user_meta( get_current_user_id(), "fullName", $fullName );
        update_user_meta( get_current_user_id(), "parent", sanitize_text_field( $request[ 'parent' ] ) );
        update_user_meta( get_current_user_id(), "nationalCode", sanitize_text_field( $request[ 'nationalCode' ] ) );
        update_user_meta( get_current_user_id(), "birthday", sanitize_text_field( $request[ 'birthday' ] ) );
        update_user_meta( get_current_user_id(), "edu", sanitize_text_field( $request[ 'edu' ] ) );
        update_user_meta( get_current_user_id(), "address", sanitize_text_field( $request[ 'address' ] ) );
        update_user_meta( get_current_user_id(), "addressPost", sanitize_text_field( $request[ 'addressPost' ] ) );

        return array(
            "massage" => "پروفایل شما با موفقیت بروز شد",
            "success" => true,

        );
    }

    public function getTeem( $request ) {

        $user_id = 0;

        if ( isset( $request[ 'teem' ] ) && ! empty( $request[ 'teem' ] ) ) {
            $user = get_user_by( 'login', $request[ 'teem' ] );

            if ( $user->ID && get_current_user_id() == get_user_meta( $user->ID, "user_leader", true ) ) {
                $user_id = $user->ID;
            }
        }

        if ( ! $user_id ) {
            $args = array(
                'meta_key'   => 'user_leader',
                'meta_value' => get_current_user_id(),
            );

            $user_query = new WP_User_Query( $args );

            if ( $user_query->get_total() >= 4 ) {
                wp_redirect( home_url( '/panel' ) );
            }
        }

        return array(

            'fullName'     => get_user_meta( $user_id, "fullName", true ),
            'parent'       => get_user_meta( $user_id, "parent", true ),
            'nationalCode' => get_user_meta( $user_id, "nationalCode", true ),
            'birthday'     => get_user_meta( $user_id, "birthday", true ),
            'edu'          => get_user_meta( $user_id, "edu", true ),

        );
    }

    public function addTeem( $request ) {

        $nationalCode = sanitize_text_field( $request[ 'nationalCode' ] );

        $args = array(
            'meta_key'   => 'nationalCode',
            'meta_value' => $nationalCode,
        );

        $user_query = new WP_User_Query( $args );

        if ( $user_query->get_total() ) {
            return array(
                "massage" => "این کاربر قبلا ثبت نام شده است",
                "success" => false,

            );
        }

        $username = rand( 10, 99 ) . intval( round( microtime( true ) * 10 ) );

        $user_id = wp_create_user( $username, wp_generate_password(), $username . '@tai.com' );

        if ( $user_id ) {
            update_user_meta( $user_id, "fullName", sanitize_text_field( $request[ 'fullName' ] ) );
            update_user_meta( $user_id, "parent", sanitize_text_field( $request[ 'parent' ] ) );
            update_user_meta( $user_id, "nationalCode", $nationalCode );
            update_user_meta( $user_id, "birthday", sanitize_text_field( $request[ 'birthday' ] ) );
            update_user_meta( $user_id, "edu", sanitize_text_field( $request[ 'edu' ] ) );
            update_user_meta( $user_id, "user_leader", get_current_user_id() );
        }

        return array(
            "massage" => $user_id ? "هم تیمی شما با موفقیت ثبت شد" : "ثبت هم تیمی شما با مشکل مواجه شده دوباره تلاش کنید",
            "success" => $user_id ? true : false,

        );
    }

    public function updateTeem( $request ) {

        $user = get_user_by( 'login', $request[ 'username' ] );

        if ( $user->ID && get_current_user_id() == get_user_meta( $user->ID, "user_leader", true ) ) {
            $user_id = $user->ID;

            update_user_meta( $user_id, "fullName", sanitize_text_field( $request[ 'fullName' ] ) );
            update_user_meta( $user_id, "parent", sanitize_text_field( $request[ 'parent' ] ) );
            update_user_meta( $user_id, "nationalCode", sanitize_text_field( $request[ 'nationalCode' ] ) );
            update_user_meta( $user_id, "birthday", sanitize_text_field( $request[ 'birthday' ] ) );
            update_user_meta( $user_id, "edu", sanitize_text_field( $request[ 'edu' ] ) );
            return array(
                "massage" => "هم تیمی شما با موفقیت ویرایش شد",
                "success" => true,

            );
        }

        return array(
            "massage" => "هم تیمی شما با موفقیت ویرایش نشد",
            "success" => false,

        );
    }

    public function sidebar() {

        $args = array(
            'post_type'      => 'post',
            'category_name'  => "news",
            'posts_per_page' => 4,
            'post_status'    => 'publish',
            'orderby'        => 'rand',

        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ):

            while ( $query->have_posts() ): $query->the_post();
                $allPost[  ] = array(
                    "title" => get_the_title(),
                    "image" => post_image_url(),
                    "link"  => get_permalink(),
                );
            endwhile;

            wp_reset_postdata();
        endif;

        return array(
            'sidebarItems' => $allPost ?? array(),
        );
    }

    public function artList() {
        $page     = $params[ 'paged' ] ?? 1;
        $per_page = $params[ 'per_page' ] ?? 20;

        $args = array(
            'post_type'      => 'matart',
            'post_status'    => 'publish',
            'posts_per_page' => $per_page,
            'paged'          => $page,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        if ( ! current_user_can( 'administrator' ) ) {
            $args[ 'author' ] = get_current_user_id();
        }

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                $tracking_code = get_post_meta( get_the_ID(), "_tracking_code", true );

                $format_art = wp_get_object_terms( get_the_ID(), 'format_art' );

                $items[  ] = array(
                    "title"  => get_the_title(),
                    "link"   => home_url( '/panel/art-info/?tracking_code=' . ( $tracking_code ?? 0 ) ),
                    "format" => ( $format_art[ 0 ]->name ?? "نا مشخص" ),
                );
            }
        }

        return array(
            'sidebarItems' => $this->sidebar(),
            'items'        => $items ?? array(),
            'pagination'   => array(
                'current_page' => absint( $page ),
                'per_page'     => absint( $per_page ),
                'total_posts'  => absint( $query->found_posts ),
                'total_pages'  => absint( $query->max_num_pages ),
                'has_next'     => absint( $page ) < absint( $query->max_num_pages ),
                'has_prev'     => absint( $page ) > 1,
            ),
        );
    }

    public function artInfo() {

        $is_administrator = current_user_can( 'administrator' );

        $formats_art = get_terms( array(
            'taxonomy'   => 'format_art',
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ) );

        $subjects_art = get_terms( array(
            'taxonomy'   => 'subject_art',
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ) );

        if ( isset( $_GET[ 'tracking_code' ] ) && ! empty( $_GET[ 'tracking_code' ] ) ) {
            $art_id = absint( substr( $_GET[ 'tracking_code' ], 8 ) );

            if (
                ! $art_id ||
                ! get_post( $art_id ) ||
                get_post_meta( $art_id, "_tracking_code", true ) != $_GET[ 'tracking_code' ]
            ) {
                wp_redirect( home_url( "/panel/artList/" ) );
                exit;
            }

            $post_author_id = get_post_field( 'post_author', $art_id );

            if ( ! $is_administrator && ! ( $post_author_id && get_current_user_id() == $post_author_id ) ) {
                wp_redirect( home_url( "/panel/artList/" ) );
                exit;
            }

            $art_title = get_the_title( $art_id );

            $format_art_select = wp_get_object_terms( $art_id, 'format_art', array( "fields" => "ids" ) );

            $formats_art[ "selected" ] = $format_art_select[ 0 ];

            $subject_art_select = wp_get_object_terms( $art_id, 'subject_art', array( "fields" => "ids" ) );

            $subjects_art[ "selected" ] = $subject_art_select[ 0 ];

            $year = get_post_meta( $art_id, "_art_year", true );

            $ownership = get_post_meta( $art_id, "_art_ownership", true );

            if ( "genuine" != $ownership && ! empty( $ownership ) ) {
                $ownership_name = $ownership;
                $ownership      = "legal";
            } else {
                $ownership = "genuine";
            }

            $documentation = get_post_meta( $art_id, "_art_documentation", true );

            $show_first = absint( get_post_meta( $art_id, "_show_first", true ) );

            if ( ! $show_first ) {
                update_post_meta( $art_id, "_show_first", 1 );
            }

            $teem_list = get_post_meta( $art_id, "_art_teem", true );

            $teem = is_array( $teem_list ) ? $teem_list : array();

            $mat_file = absint( get_post_meta( $art_id, '_art_file', true ) );
            $file_url = wp_get_attachment_url( $mat_file );
        } else {
            $args = array(
                'post_type'      => 'matart',
                'post_status'    => "any",
                'posts_per_page' => -1,
                'fields'         => 'ids',
            );

            if ( ! $is_administrator ) {
                $args[ 'author' ] = get_current_user_id();
            }

            $query = new WP_Query( $args );
            $count = $query->found_posts;

            wp_reset_postdata();

            if ( $count >= 10 ) {
                wp_redirect( '/panel/artList/' );
            }
        }

        return array(

            'sidebarItems'   => $this->sidebar(),
            'formats_art'    => $formats_art,
            'art_title'      => $art_title ?? "",
            'subjects_art'   => $subjects_art,
            'year'           => $year ?? "",
            'ownership'      => $ownership ?? "genuine",
            'ownership_name' => $ownership_name ?? null,
            'documentation'  => $documentation ?? "",
            'art_file'       => $file_url ?? "",
            'teems'          => $teem ?? array(),
            'show_first'     => $show_first ?? 1,

        );
    }

    public function sendArtInfo( $request, $file ) {

        $action = "create";

        if ( isset( $request[ 'tracking_code' ] ) && ! empty( $request[ 'tracking_code' ] ) ) {
            $art_id = absint( substr( $request[ 'tracking_code' ], 8 ) );

            $post_author_id = get_post_field( 'post_author', $art_id );

            if ( current_user_can( 'administrator' ) || ( $post_author_id && get_current_user_id() == $post_author_id ) ) {
                $action = "update";
            }

            if ( ! get_post( $art_id ) ) {
                $action = "create";
            }
        }

        $this->checkTaxonomy( $request );

        if ( "update" == $action ) {
            $this->updateArt( $art_id, $request );

            $massage = "اثر شما با موفقیت ویرایش شد";
        }

        if ( "create" == $action ) {
            $create = $this->createArt( $request, $file );
            $art_id = $create[ 'id' ];

            $massage = $create[ 'tracking_code' ];
        }

        $this->setMeta( $request, $art_id );

        $this->setTaxonomy( $request, $art_id );

        $this->uploadArtFile( $file[ 'art_file' ] ?? null, $art_id );

        $this->uploadDocumentation( $file, $art_id, $request );

        return array(
            "massage" => $massage,
            "data"    => $action,

        );
    }

    public function createArt( $request ) {

        if ( ! current_user_can( 'mat_leader' ) ) {
            throw new \Exception( "شما دسترسی ایجاد اثر جدید را ندارید" );
        }

        if ( empty( $request[ 'art_title' ] ) ) {
            throw new \Exception( "عنوان اثر نمی‌تواند خالی باشد" );
        }

        $post_data = array(
            'post_title'  => sanitize_text_field( $request[ 'art_title' ] ),
            'post_type'   => 'matart',
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_date'   => current_time( 'mysql' ),
            'meta_input'  => array(
                '_show_first' => 0,
            ),
        );

        $art_id = wp_insert_post( $post_data, true );

        if ( is_wp_error( $art_id ) ) {
            throw new \Exception( "خطا در ایجاد اثر: " . $art_id->get_error_message() );
        }

        if ( 0 === $art_id ) {
            throw new \Exception( "ایجاد اثر با مشکل مواجه شد" );
        }

        $tracking_code = rand( 10000000, 99999999 ) . $art_id;

        update_post_meta( $art_id, "_tracking_code", $tracking_code );

        return array(
            'id'            => $art_id,
            'tracking_code' => $tracking_code,
        );
    }

    public function updateArt( $art_id, $request ) {

        $result = wp_update_post( array(
            'ID'          => $art_id,
            'post_title'  => sanitize_text_field( $request[ 'art_title' ] ),
            'post_status' => 'publish',
        ) );

        if ( ! $result ) {
            throw new \Exception( "بروزرسانی با مشکل برخورد کرده دوباره تلاش کنید" );
        }
    }

    public function setMeta( $request, $art_id ) {
        $ownership = $request[ 'ownership' ];

        if ( "legal" == $request[ 'ownership' ] ) {
            $ownership = $request[ 'ownership_name' ];
        }

        update_post_meta( $art_id, "_art_year", $request[ 'year' ] );
        update_post_meta( $art_id, "_art_ownership", $ownership );
        update_post_meta( $art_id, "_art_teem", $request[ "teem" ] ?? array() );

        unset( $request[ 'year' ] );
        unset( $request[ 'ownership' ] );
        unset( $request[ 'ownership_name' ] );
    }

    public function setTaxonomy( $request, $art_id ) {

        $term = get_term( absint( $request[ 'format_art' ] ), 'format_art' );

        if ( ! $term || is_wp_error( $term ) ) {
            throw new \Exception( 'قالب انتخاب شده وجود ندارد' );
        }

        $set = wp_set_object_terms( $art_id, array( absint( $request[ 'format_art' ] ) ), 'format_art', false );

        if ( is_wp_error( $set ) ) {
            throw new \Exception( "ثبت قالب به مشکل خورده است دوباره تلاش کنید" );
        }

        $term = get_term( absint( $request[ 'subject_art' ] ), 'subject_art' );

        if ( ! $term || is_wp_error( $term ) ) {
            throw new \Exception( 'موضوع انتخاب شده وجود ندارد' );
        }

        $set = wp_set_object_terms( $art_id, array( absint( $request[ 'subject_art' ] ) ), 'subject_art', false );

        if ( is_wp_error( $set ) ) {
            throw new \Exception( "ثبت موضوع به مشکل خورده است دوباره تلاش کنید" );
        }
    }

    public function checkTaxonomy( $request ) {

        $args = array(
            'post_type'      => 'matart',
            'author'         => get_current_user_id(),
            'post_status'    => "any",
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'format_art',
                    'field'    => 'term_id',
                    'terms'    => absint( $request[ 'format_art' ] ),
                ),
            ),
        );
        $query = new WP_Query( $args );
        $count = $query->found_posts;

        wp_reset_postdata();

        if ( $count >= 5 ) {
            throw new \Exception( "شما نمیتوانید بیش از 5 اثر در این قالب ارسال کنید" );
        }
    }

    public function uploadArtFile( $file, $art_id ) {

        if ( isset( $file ) && ! empty( $file[ 'name' ] ) ) {
            $old_file = absint( get_post_meta( $art_id, '_art_file', true ) );

            $upload = $this->uploadFile( $file );

            if ( $old_file ) {
                wp_delete_attachment( $old_file, true );
            }

            update_post_meta( $art_id, '_art_file', $upload );
        }
    }

    public function uploadDocumentation( $files, $art_id, $request ) {

        unset( $files[ 'art_file' ] );

        $documentation_meta = explode( ",", get_post_meta( $art_id, "_art_documentation", true ) );

        $documentation = explode( ",", $request[ 'documentation' ] );

        $missingItems = array_diff( sanitize_no_item( $documentation_meta ), sanitize_no_item( $documentation ) );

        foreach ( $missingItems as $item ) {
            wp_delete_attachment( $item, true );
        }

        if ( $files ) {
            foreach ( $files as $file ) {
                if ( isset( $file ) && ! empty( $file[ 'name' ] ) ) {
                    $documentation[  ] = $this->uploadFile( $file );
                    update_post_meta( $art_id, '_art_documentation', implode( ",", sanitize_no_item( $documentation ) ) );
                }
            }
        }

        update_post_meta( $art_id, '_art_documentation', implode( ",", sanitize_no_item( $documentation ) ) );
    }

    public function uploadFile( $file ) {
        $maxFileSize = 700 * 1024 * 1024;

        if ( empty( $file ) || empty( $file[ 'name' ] ) || empty( $file[ 'tmp_name' ] ) ) {
            throw new \Exception( "فایل معتبر نیست." );
        }

        $fileName = $file[ 'name' ];
        $ext      = strtolower( pathinfo( $fileName, PATHINFO_EXTENSION ) );

        if ( 'zip' !== $ext ) {
            throw new \Exception( "فایل باید به صورت zip ارسال شود." );
        }

        if ( ! empty( $file[ 'size' ] ) && $file[ 'size' ] > $maxFileSize ) {
            throw new \Exception( "حجم فایل بیش از حد مجاز است." );
        }

        $wp_upload_dir = wp_upload_dir();

        if ( ! wp_is_writable( $wp_upload_dir[ 'path' ] ) ) {
            throw new \Exception( "پوشه آپلود قابل نوشتن نیست. لطفا مجوزهای پوشه uploads را بررسی کنید." );
        }

        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        $file[ 'name' ] = basename( $fileName, '.zip' ) . '-' . wp_generate_password( 8, false ) . '.zip';

        $upload_overrides = array(
            'test_form' => false,
            'test_type' => true,
            'mimes'     => array(
                'zip' => 'application/zip',
            ),
        );

        $old_error_reporting = error_reporting( E_ALL );
        $old_display_errors  = ini_get( 'display_errors' );
        ini_set( 'display_errors', 1 );

        try {
            $moveFile = wp_handle_upload( $file, $upload_overrides );

            error_log( "File upload attempt: " . print_r( $file, true ) );
            error_log( "Upload result: " . print_r( $moveFile, true ) );

            if ( ! $moveFile || isset( $moveFile[ 'error' ] ) ) {
                $error_message = $moveFile[ 'error' ] ?? 'unknown';

                $common_errors = array(
                    'Could not write file to disk'                                 => 'مشکل در نوشتن روی دیسک. مجوز پوشه uploads را بررسی کنید.',
                    'File exceeds upload_max_filesize'                             => 'حجم فایل بیشتر از محدودیت سرور است.',
                    'The uploaded file exceeds the MAX_FILE_SIZE directive'        => 'حجم فایل بیشتر از محدودیت فرم است.',
                    'Invalid file type'                                            => 'نوع فایل مجاز نیست.',
                    'Sorry, this file type is not permitted for security reasons.' => 'این نوع فایل برای امنیت مجاز نیست.',
                );

                $user_message = isset( $common_errors[ $error_message ] )
                    ? $common_errors[ $error_message ]
                    : "خطایی در زمان بارگذاری رخ داده: " . $error_message;

                throw new \Exception( $user_message . " (فایل: " . $fileName . ")" );
            }
        } catch ( Exception $e ) {
            error_reporting( $old_error_reporting );
            ini_set( 'display_errors', $old_display_errors );
            throw $e;
        }

        error_reporting( $old_error_reporting );
        ini_set( 'display_errors', $old_display_errors );

        $attachment = array(
            'guid'           => $moveFile[ 'url' ],
            'post_mime_type' => $moveFile[ 'type' ],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $moveFile[ 'file' ] ) ),
            'post_content'   => '',
            'post_status'    => 'inherit',
        );

        $attach_id = wp_insert_attachment( $attachment, $moveFile[ 'file' ] );

        if ( is_wp_error( $attach_id ) || ! $attach_id ) {
            throw new \Exception( "ثبت فایل با خطا مواجه شد." );
        }

        require_once ABSPATH . 'wp-admin/includes/image.php';
        wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $moveFile[ 'file' ] ) );

        return $attach_id;
    }
}

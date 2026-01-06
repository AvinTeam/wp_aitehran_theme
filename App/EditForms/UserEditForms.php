<?php
namespace TAI\App\EditForms;

use TAI\App\Core\Traits\AdminMessageTrait;
use WP_User_Query;

( defined( 'ABSPATH' ) ) || exit;

class UserEditForms {

    use AdminMessageTrait;

    public function __construct() {

        add_action( 'edit_user_profile', array( $this, "dsl_user_inputs" ) );
        add_action( 'show_user_profile', array( $this, "dsl_user_inputs" ) );
        add_action( 'user_new_form', array( $this, "dsl_user_inputs" ) );
        add_action( 'edit_user_profile_update', array( $this, "dsl_update_user" ) );
        add_action( 'personal_options_update', array( $this, "dsl_update_user" ) );
    }

    public function dsl_user_inputs( $user ) {

        if ( is_a( $user, 'WP_User' ) ) {
            $mobile              = $user->mobile;
            $nationalCode        = $user->nationalCode;
            $address             = $user->address;
            $user_leader         = absint( $user->user_leader );
            $parent              = $user->parent;
            $birthday            = $user->birthday;
            $edu                 = $user->edu;
            $mat_referee_massage = $user->mat_referee_massage;
            $addressPost         = $user->addressPost;
            $mat_referee_massage = $user->mat_referee_massage;
            $user_role           = '';

            if ( in_array( 'mat_user', (array) $user->roles ) ) {
                $args = array(
                    'role'    => 'mat_leader',
                    'orderby' => 'display_name',
                    'order'   => 'ASC',
                );

                $mat_leader_option = get_users( $args );
                $user_role         = 'mat_user';
            }

            if ( in_array( 'mat_referee', (array) $user->roles ) ) {
                $args = array(
                    'role'    => 'mat_admin',
                    'orderby' => 'display_name',
                    'order'   => 'ASC',
                );

                $mat_leader_option = get_users( $args );
                $user_role         = 'mat_referee';
            }
        }

        view( 'admin/userForm', array(
            "mobile"              => $mobile ?? "",
            "nationalCode"        => $nationalCode ?? "",
            "mat_referee_massage" => $mat_referee_massage ?? "",
            "user_leader"         => $user_leader ?? "",
            "user_role"           => $user_role ?? "",
            "parent"              => $parent ?? "",
            "birthday"            => $birthday ?? "",
            "edu"                 => $edu ?? "",
            "address"             => $address ?? "",
            "addressPost"         => $addressPost ?? "",
        ) );
    }

    public function dsl_update_user( $user_id ) {

        if ( ! current_user_can( 'edit_user', $user_id ) ) {
            exit;
        }

        if ( isset( $_POST[ 'parent' ] ) ) {
            update_user_meta( $user_id, 'parent', $_POST[ 'parent' ] );
        }

        if ( isset( $_POST[ 'nationalCode' ] ) ) {
            $nationalCode = $_POST[ 'nationalCode' ];

            if ( ! national_code( $nationalCode ) ) {
                $this->error( "کد ملی معتبر نیست از کد ملی درست استفاده نمایید" );
                exit;
            }

            $nationalCodeOld = get_user_meta( $user_id, "nationalCode", true );

            if ( $nationalCodeOld != $nationalCode ) {
                $args = array(
                    'meta_key'   => 'nationalCode',
                    'meta_value' => $nationalCode,
                );

                $user_query = new WP_User_Query( $args );

                if ( $user_query->get_total() ) {
                    $this->error( "این کاربر قبلا ثبت نام شده است" );
                    exit;
                }
            }

            update_user_meta( $user_id, 'nationalCode', $_POST[ 'nationalCode' ] );
        }

        if ( isset( $_POST[ 'birthday' ] ) ) {
            update_user_meta( $user_id, 'birthday', $_POST[ 'birthday' ] );
        }

        if ( isset( $_POST[ 'edu' ] ) ) {
            update_user_meta( $user_id, 'edu', $_POST[ 'edu' ] );
        }

        if ( isset( $_POST[ 'address' ] ) ) {
            update_user_meta( $user_id, 'address', $_POST[ 'address' ] );
        }

        if ( isset( $_POST[ 'addressPost' ] ) ) {
            update_user_meta( $user_id, 'addressPost', $_POST[ 'addressPost' ] );
        }

        if ( isset( $_POST[ 'mobile' ] ) ) {
            $mobile = sanitize_phone( $_POST[ 'mobile' ] );
            update_user_meta( $user_id, 'mobile', $mobile );
        }

        if ( isset( $_POST[ 'leader' ] ) ) {
            $mobile = absint( $_POST[ 'leader' ] );
            update_user_meta( $user_id, 'leader', $mobile );
        }
    }
}

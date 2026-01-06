<?php
namespace TAI\App\EditColumn;

( defined( 'ABSPATH' ) ) || exit;

class UserEditColumn {

    public function __construct() {

        // add_action( 'init', array( $this, 'init' ), 11 );
        add_filter( 'manage_users_custom_column', array( $this, 'show_leader_column_content' ), 0, 3 );
        add_filter( 'manage_users_columns', array( $this, 'add_leader_column' ) );
    }

    public function add_leader_column( $columns ) {

        if ( isset( $columns[ 'email' ] ) ) {
            unset( $columns[ 'email' ] );
        }

        if ( isset( $columns[ 'posts' ] ) ) {
            unset( $columns[ 'posts' ] );
        }

        if ( isset( $columns[ 'name' ] ) ) {
            unset( $columns[ 'name' ] );
        }

        $columns[ 'fullname' ]      = 'نام و نام خانوادگی';
        $columns[ 'user_leader' ]   = 'سر تیم';
        $columns[ 'mobile' ] = 'شماره موبایل';
        $columns[ 'nationalCode' ] = 'کد ملی';

        return $columns;
    }

    public function show_leader_column_content( $value, $column_name, $user_id ) {

        if ( 'user_leader' === $column_name ) {
            $leader_id = get_user_meta( $user_id, 'user_leader', true );

            if ( $leader_id ) {
                $leader = get_userdata( $leader_id );

                if ( $leader ) {
                    $leader_name = esc_html( $leader->display_name );
                    $filter_url  = add_query_arg( 'leader_id', $leader_id, admin_url( 'users.php' ) );
                    return '<a href="' . esc_url( $filter_url ) . '">' . $leader_name . '</a>';
                }
            }

            return '—';
        }

        if ( 'mobile' === $column_name ) {
            $mobile = get_user_meta( $user_id, 'mobile', true );
            return $mobile ? esc_html( $mobile ) : '—';
        }

        if ( 'nationalCode' === $column_name ) {
            $nationalCode = get_user_meta( $user_id, 'nationalCode', true );
            return $nationalCode ? esc_html( $nationalCode ) : '—';
        }

        if ( 'fullname' === $column_name ) {
            $fullName = get_user_meta( $user_id, 'fullName', true );
            return ! empty( $fullName ) ? esc_html( $fullName ) : '';
        }

        return $value;
    }
}

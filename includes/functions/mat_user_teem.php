<?php
( defined( 'ABSPATH' ) ) || exit;

function mat_user_teem( $userid ) {
    $args = array(
        'meta_key'   => 'user_leader',
        'meta_value' => $userid,
     );

    $user_query = new WP_User_Query( $args );

    $users = $user_query->get_results();

    $user_data = array(  );

    if ( ! empty( $users ) ) {
        foreach ( $users as $user ) {
            $user_data[  ] = array(
                'username' => $user->user_login,
                'name'     => $user->display_name,
                'code'     => $user->nationalCode,
             );
        }
    }

    return array(
        'total' => $user_query->get_total(),
        'list'  => $user_data,
     );
}

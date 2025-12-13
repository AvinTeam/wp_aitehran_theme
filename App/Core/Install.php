<?php
namespace TAI\App\Core;

use TAI\App\Modules\Rewrites\UserPanelRewrites;

( defined( 'ABSPATH' ) ) || exit;

class Install {
    private $wpdb;
    private string $db_name_key;

    public function __construct() {
        $this->db_name_key = config( 'app.key' );
        global $wpdb;
        $this->wpdb = $wpdb;
        add_action( 'after_switch_theme', array( $this, 'install' ) );
    }

    public function install() {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $this->db_log() );

        ( new UserPanelRewrites() )->add_rewrite();

        flush_rewrite_rules();

        $this->add_role();
    }

    private function prefix( $name ) {
        return $this->wpdb->prefix . $this->db_name_key . $name;
    }

    private function db_log() {
        $table_name    = $this->prefix( 'tai_logs' );
        $table_collate = $this->wpdb->collate;

        return " CREATE TABLE IF NOT EXISTS `$table_name` (
                    `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
                    `user_mobile` varchar(11) NOT NULL,
                    `log_type` varchar(20) COLLATE $table_collate NOT NULL,
                    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`ID`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=$table_collate";
    }

    private function add_role() {

        if ( get_role( 'mat_user' ) == null ) {
            add_role(
                'mat_user',
                'عضو تیم',
                array(
                    'read' => true,

                 )
            );
        }

        if ( get_role( 'mat_leader' ) == null ) {
            add_role(
                'mat_leader',
                'سر تیم',
                array(
                    'read'                   => true,
                    'read_matart'            => true,
                    'edit_matart'            => true,
                    'edit_matarts'           => true,
                    'publish_matarts'        => true,
                    'edit_published_matarts' => true,
                    'mat_alf'                => true,
                    'mat_leader'             => true,

                 )
            );
        }

        // if ( get_role( 'mat_referee' ) == null ) {
        //     add_role(
        //         'mat_referee',
        //         'داور جشنواره',
        //         array(
        //             'read'         => true,
        //             'read_matart'  => true,
        //             'edit_matarts' => true,
        //             //'edit_others_matarts' => true,
        //             'mat_alf'      => true,
        //             'mat_referee'  => true,
        //          )
        //     );
        // }

        if ( get_role( 'mat_admin' ) == null ) {
            add_role(
                'mat_admin',
                'مدیر جشنواره',
                array(
                    'read'         => true,
                    'mat_alf'      => true,
                    'create_users' => true,
                    'mat_admin'    => true,

                 )
            );
        }

        $admin_role = get_role( 'administrator' );

        if ( ! array_key_exists( 'mat_administrator', $admin_role->capabilities ) ) {
            $admin_role->add_cap( 'mat_administrator' );
            $admin_role->add_cap( 'mat_admin' );
            $admin_role->add_cap( 'mat_referee' );
            $admin_role->add_cap( 'mat_leader' );
            $admin_role->add_cap( 'mat_alf' );
            $admin_role->add_cap( 'edit_matart' );
            $admin_role->add_cap( 'read_matart' );
            $admin_role->add_cap( 'delete_matart' );
            $admin_role->add_cap( 'edit_matarts' );
            $admin_role->add_cap( 'edit_others_matarts' );
            $admin_role->add_cap( 'delete_matarts' );
            $admin_role->add_cap( 'publish_matarts' );
            $admin_role->add_cap( 'edit_published_matarts' );
            $admin_role->add_cap( 'edit_private_matarts' );
            $admin_role->add_cap( 'delete_others_matarts' );
            $admin_role->add_cap( 'read_private_matarts' );
            $admin_role->add_cap( 'delete_published_matarts' );
            $admin_role->add_cap( 'delete_private_matarts' );
        }
    }
}

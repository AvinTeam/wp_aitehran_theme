<?php
namespace TAI\App\Core;

use TAI\App\Modules\Rewrites\UserPanelRewrites;

( defined( 'ABSPATH' ) ) || exit;

class Install {
    private $wpdb;
    private string $db_name_key;
    private string $collate;

    public function __construct() {
        $this->db_name_key = config( 'app.key' );
        global $wpdb;
        $this->wpdb    = $wpdb;
        $this->collate = $this->wpdb->collate;

        add_action( 'after_switch_theme', array( $this, 'install' ) );
    }

    public function install() {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $this->db_log() );
        dbDelta( $this->db_contact() );
        dbDelta( $this->db_groups() );
        dbDelta( $this->db_iran() );

        ( new UserPanelRewrites() )->add_rewrite();

        flush_rewrite_rules();

        $this->add_role();
        $this->add_category();
        // $this->insert_iran();
    }

    private function prefix( $name ) {
        return $this->wpdb->prefix . $this->db_name_key . $name;
    }

    private function db_log() {
        $table_name = $this->prefix( 'logs' );

        return " CREATE TABLE IF NOT EXISTS `$table_name` (
                    `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
                    `user_mobile` varchar(11) NOT NULL,
                    `log_type` varchar(20) COLLATE {$this->collate} NOT NULL,
                    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`ID`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE={$this->collate}";
    }

    private function db_contact() {
        $table_name = $this->prefix( 'contact' );

        return " CREATE TABLE IF NOT EXISTS `$table_name` (
                    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                    `first_name` varchar(255) COLLATE {$this->collate} NOT NULL,
                    `last_name` varchar(255) COLLATE {$this->collate} NOT NULL,
                    `mobile` varchar(11) COLLATE {$this->collate} NOT NULL,
                    `description` longtext COLLATE {$this->collate} NOT NULL,
                    `status` enum('noRead','read') CHARACTER SET utf8mb4 COLLATE {$this->collate} NOT NULL DEFAULT 'noRead',
                    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE={$this->collate} ";
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

    private function add_category() {

        $main_categories = array(
            'news'    => 'اخبار',
            'ai_news' => 'اخبار هوش مصنوعی',
            'sliders' => 'اسلایدر',
            'gallery' => 'گالری تصاویر',
            'videos'  => 'ویدئو آموزشی',
        );

        foreach ( $main_categories as $slug => $name ) {
            $term = term_exists( $slug, 'category' );

            if ( ! $term ) {
                wp_insert_term( $name, 'category', array(
                    'slug'        => $slug,
                    'description' => $name,
                ) );
            }
        }
    }

    private function db_iran() {
        $table_name = $this->prefix( 'iran' );

        return " CREATE TABLE IF NOT EXISTS  `$table_name` (
                    `id` int NOT NULL AUTO_INCREMENT,
                    `name` varchar(100) COLLATE {$this->collate} NOT NULL,
                    `province_id` int NOT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE={$this->collate}";
    }

    private function db_groups() {
        $table_name = $this->prefix( 'groups' );

        $users_table = $this->wpdb->users;

        return " CREATE TABLE IF NOT EXISTS  `$table_name` (
                    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                    `user_id` bigint unsigned NOT NULL,
                    `province_id` int NOT NULL,
                    `city_id ` int NOT NULL,
                    `area_id ` int NOT NULL,
                    PRIMARY KEY (`id`),
                    FOREIGN KEY (`user_id`) REFERENCES `$users_table`(`id`) ON DELETE CASCADE
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE={$this->collate}";
    }
}

<?php
namespace TAI\App\Modules\ListTable;

use TAI\App\Core\Traits\JDF;
use TAI\App\Models\Contact;
use WP_List_Table;

( defined( 'ABSPATH' ) ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class ContactsListTable extends WP_List_Table {

    use JDF;

    private $all_results;
    private $par_page = 25;
    private $m        = 0;

    public function get_columns() {
        return array(
            'row'        => '#',
            'user_name'  => 'نام و نام خانوادگی',
            'mobile'     => 'شماره موبایل',
            'log_type'   => 'وضعیت',
            'created_at' => 'زمان ثبت',
            'updated_at' => 'تاریخ آخرین تغییرات',
            'action'     => '',

        );
    }

    public function column_default( $item, $column_name ) {

        if ( isset( $item[ $column_name ] ) ) {
            return wp_kses( $item[ $column_name ], array(
                'span' => array(),
            ) );
        }

        return '-';
    }

    public function column_user_name( $item ) {

        return sprintf( "%s %s", $item[ 'first_name' ], $item[ 'last_name' ] );
    }

    public function column_action( $item ) {

        return sprintf( "<a href='%s' >مشاهده</a>", admin_url( 'admin.php?page=tai-contacts-us&id=' . $item[ 'id' ] ) );
    }

    public function column_log_type( $item ) {

        switch ( $item[ 'status' ] ) {
            case 'read':
                $type = '<span class="dashicons dashicons-buddicons-pm text-success f-32"></span>';
                break;
            case 'noRead':
                $type = '<span class="dashicons dashicons-email-alt text-warning f-32"></span>';
                break;
            default:
                $type = '-';
                break;
        }

        return $type;
    }

    public function column_created_at( $item ) {
        return $this->date( $item[ 'created_at' ] );
    }

    public function column_updated_at( $item ) {
        return $this->date( $item[ 'updated_at' ] );
    }

    public function get_bulk_actions() {

        if ( current_user_can( 'manage_options' ) ) {
            $action[ 'delete' ] = esc_html__( 'delete', 'mraparat' );
        }

        //return $action;
    }

    public function column_row( $item ) {
        ++$this->m;
        return $this->m;
    }

    public function no_items() {

        echo 'چیزی یافت نشد';
    }

    public function prepare_items() {

        $search = isset( $_REQUEST[ 's' ] ) ? sanitize_text_field( $_REQUEST[ 's' ] ) : '';
        $status = ( isset( $_GET[ 'status' ] ) && "all" != $_GET[ 'status' ] ) ? sanitize_text_field( $_GET[ 'status' ] ) : "";

        $offset = isset( $_GET[ 'paged' ] ) ? ( absint( $_GET[ 'paged' ] ) - 1 ) : 0;

        $contacts = Contact::all()
            ->orderBy( 'id', 'DESC' );

        if ( ! empty( $search ) ) {
            $contacts = $contacts->where( 'first_name', 'LIKE', "%{$search}%" )
                ->orWhere( 'last_name', 'LIKE', "%{$search}%" )
                ->orWhere( 'mobile', 'LIKE', "%{$search}%" );
        }

        if ( ! empty( $status ) && in_array( $status, array( 'noRead', 'read' ) ) ) {
            $contacts = $contacts->where( 'status', $status );
        }

        $this->items = $contacts
            ->limit( $this->par_page, $offset )
            ->toArray();

        $this->process_bulk_action();

        $this->set_pagination_args( array(
            'total_items' => $contacts->count(),
            'per_page'    => $this->par_page,
        ) );

        $this->_column_headers = array(
            $this->get_columns(),
            array(),
            null,
            'user_name',
        );
    }

    private function create_view( $key, $label, $url, $count = 0 ) {
        $current_status = isset( $_GET[ 'status' ] ) ? $_GET[ 'status' ] : 'all';

        $view_tag = sprintf( '<a href="%s" %s>%s</a>', $url, $current_status == $key ? 'class="current"' : '', $label );

        $view_tag .= sprintf( '<span class="count">(%d)</span>', $count );

        return $view_tag;
    }

    protected function get_views() {

        return array(
            'all'    => $this->create_view( 'all', 'همه', admin_url( 'admin.php?page=tai-contacts-us&status=all' ), Contact::allStatusCount() ),
            'read'   => $this->create_view( 'read', 'پیام خوانده شده', admin_url( 'admin.php?page=tai-contacts-us&status=read' ), Contact::allStatusCount( 'read' ) ),
            'noRead' => $this->create_view( 'noRead', 'پیام خوانده نشده', admin_url( 'admin.php?page=tai-contacts-us&status=noRead' ), Contact::allStatusCount( 'noRead' ) ),

        );
    }
}

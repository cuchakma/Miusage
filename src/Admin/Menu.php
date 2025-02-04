<?php

namespace AwsomeMotive\Miusage\Admin;

use AwsomeMotive\Miusage\Helpers;
use AwsomeMotive\Miusage\Models\AssetModel;

class Menu {

    private $page_title = 'Miusage';

    private $menu_title = 'Miusage';

    private $capability = 'manage_options';

    private $menu_slug = 'miusage';

    private $icon = 'dashicons-share-alt2';

    private $position = '10';

    private $menu_path = VIEWS_PATH . 'admin/menu-template.php';

    private $assets_object;

    public function __construct( AssetModel $assets ) {
        $this->assets_object = $assets;
        add_action( 'admin_menu', [$this, 'intialize_menu'] );
        add_action( 'admin_enqueue_scripts', [$this, 'register_styles_scripts'] );
    }

    public function intialize_menu() {
        add_menu_page( $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, [$this, 'miusage_menu_view'], $this->icon, $this->position );
    }

    public function register_styles_scripts( $hook ) {
        $script_deps = require_once MIUSAGE_ROOT_PATH . '/build/miusage-entry.asset.php';
        $this->assets_object->insert_style_deps( 'miusage.css', 'miusage-admin', [], rand(), 'toplevel_page_miusage' );
        $this->assets_object->insert_script_deps( 'miusage-entry.js', 'miusage-admin', $script_deps['dependencies'], $script_deps['version'], false, 'toplevel_page_miusage' );
        $this->assets_object->register_misuage_style();
        $this->assets_object->register_misuage_script();

        if ( $hook === 'toplevel_page_miusage' ) {
            $this->assets_object->enqueue_style( 'miusage-admin' );
        }

        if ( $hook === 'toplevel_page_miusage' ) {
            $this->assets_object->enqueue_script( 'miusage-admin' );
        }
    }

    public function miusage_menu_view() {
        Helpers::render_template( $this->menu_path );
    }
}
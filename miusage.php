<?php
/**
 * Plugin Name: Miusage
 * Plugin URI:  www.facebook.com
 * Description: This plugin belongs to miusage.
 * Version:     1.0.0
 * Author:      Cupid Chakma
 * Author URI:  Cupid Chakma
 * Text Domain: miusage
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package     Miusage
 * @author      Awsome Motive
 * @copyright   2023 Awsome Motive
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 *
 * Prefix:      Plugin Functions Prefix
 */

require_once __DIR__ . '/vendor/autoload.php';

use DI\ContainerBuilder;
use AwsomeMotive\Miusage\Admin\Menu;

final Class Miusage {
    public static $instance = null;
    public static function init() {
        if ( self::$instance == null ) {
            self::define_constants();
            self::$instance = self::intialize_container();
            self::$instance->get( Menu::class );
        }
        return self::$instance;
    }

    public static function intialize_container() {
        $builder = new ContainerBuilder();
        $builder->addDefinitions( require_once __DIR__ . '/config.php' );
        return $builder->build();
    }

    public static function define_constants() {
        define( 'VIEWS_PATH', __DIR__ . '/views/' );
        define( 'MIUSAGE_URL', plugin_dir_url( __FILE__ ) );
        define( 'ADMIN_ASSETS_PATH', MIUSAGE_URL . 'assets/admin/css' );
    }
}

Miusage::init();
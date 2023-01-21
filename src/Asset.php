<?php

namespace AwsomeMotive\Miusage;

use stdClass;
use AwsomeMotive\Miusage\Models\AssetModel;

class Asset extends AssetModel {

    /**
     * Inserting Style Dependencies For Style Loading
     *
     * @param string $filename
     * @param string $handle
     * @param array $deps
     * @param int $version
     * @param string $screen
     * @return void
     */
    public function insert_style_deps( $filename, $handle, $deps, $version, $screen ) {
        $asset_object          = new stdClass();
        $asset_object->fileurl = $this->asset_path . '/' . $filename;
        $asset_object->handle  = $handle;
        $asset_object->deps    = $deps;
        $asset_object->version = $version;
        $asset_object->screen  = $screen;
        array_push( $this->asset_handles, $asset_object );
    }

    public function register_misuage_style() {
        global $current_screen;
        foreach ( $this->asset_handles as $asset_object ) {
            if ( $current_screen->base === $asset_object->screen ) {
                wp_register_style( $asset_object->handle, $asset_object->fileurl, $asset_object->deps, $asset_object->version );
            }
        }
    }

    public function enqueue_style( $handle ) {
        foreach ( $this->asset_handles as $object ) {
            if ( $object->handle === $handle ) {
                wp_enqueue_style( $handle );
            }
        }
    }
}
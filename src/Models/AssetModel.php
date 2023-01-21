<?php

namespace AwsomeMotive\Miusage\Models;

abstract class AssetModel {

    protected $asset_path;

    protected $asset_handles = [];

    public static $instance = 0;

    public function __construct( $asset_path ) {
        $this->asset_path = $asset_path;
        ++self::$instance;
    }

    public function register_style( $handle, $deps, $version, $screen ) {}

    public function enqueue_style( $handle ) {}
}
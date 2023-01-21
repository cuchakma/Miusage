<?php

use AwsomeMotive\Miusage\Asset;
use AwsomeMotive\Miusage\Admin\Menu;

return [
    Asset::class => DI\create( Asset::class )->constructor( ADMIN_ASSETS_PATH ),
    Menu::class  => DI\create( Menu::class )->constructor( DI\get( Asset::class ) )
];
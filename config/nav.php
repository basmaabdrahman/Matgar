<?php
return [[
    'name'=>'Home',
    'label'=>'nav-label',
    'route'=>'dashboard.dashboard',
    'icon'=>'icon-speedometer menu-icon',
    'active'=>'dashboard.dashboard'
    ],
    [
        'name'=>'Categories',
        'label'=>'mega-menu mega-menu-sm',
        'route'=>'dashboard.categories.index',
        'icon'=>'icon-globe-alt menu-icon',
        'active'=>'dashboard.categories.*'

    ],
];

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?= bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title('|', true, 'right'); ?></title>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div>
        <div id="header" class="header-sticky scroll">
            <div class="container-fluid header-container">
                <div class="row main-row">
                    <div class="col-lg-2 col-12 logo-col">
                        <a href="<?= get_bloginfo('url'); ?>">
                            <img src="<?php esc_url(header_image()); ?>" class="img-fluid" alt="<?= get_bloginfo('name'); ?>" />
                        </a>
                    </div>
                    <div class="col-lg-10 menu-col">
                        <?php
                        $menu_args = array(
                            'menu' => 'Main Menu',
                            'menu_class' => 'top-menu',
                        );
                        wp_nav_menu($menu_args);
                        ?>
                    </div>
                    <div class="col-sm-2 col-md-2 col-2 mmenu-col" style="display: none">
                        <a href="#mmenu" class="mmenu_mobile">
                            <i class="fas fa-bars fa-size"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="mobile-header" class="hidden d-none">
            <nav id="mmenu">
                <?php
                $menu_args = array(
                    'menu' => 'Main Menu',
                    'menu_class' => 'mobile-menu',
                );
                wp_nav_menu($menu_args);
                ?>
            </nav>
        </div>

        <div id="app" class="page-content">
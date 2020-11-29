<?php

/**
 * Page Banner
 * 
 * view('page-banner', array $args)
 */

?>

<div id="page-banner" style="background: url(<?= $banner_image ?>) center/cover no-repeat">
    <div class="overlay"></div>
    <div class="page-banner-content container z-index-2">
        <div class="banner-title">
            <h1 class="banner-text"><?= $banner_title ?></h1>
        </div>
    </div>
</div>
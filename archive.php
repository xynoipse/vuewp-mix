<?php

defined('ABSPATH') || exit;

get_header();

$postType = getArchivePostType();

?>

<div id="archive" class="archive-container mb-5">
    <div class="container">

        <?php

        if (have_posts()) {
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        }

        ?>

    </div>
</div>

<?php

get_footer();

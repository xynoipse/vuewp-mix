<?php

/**
 * Pagination View
 * 
 * view( 'pagination')
 */

if (!paginate_links()) return; ?>

<div class="default-pagination archive_pagination text-center">
    <?php
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '<i class="fas fa-arrow-left"></i>',
        'next_text' => '<i class="fas fa-arrow-right"></i>',
    ));
    ?>
</div>
<?php

/**
 * Get the current archive post type name (e.g: post, page, product).
 *
 * @return String|Boolean  The archive post type name or false if not in an archive page.
 */
if (!function_exists('getArchivePostType')) {
    function getArchivePostType()
    {
        return is_archive() ? get_queried_object()->name : false;
    }
}

/**
 * Get the current single post type name (e.g: post, page, product).
 *
 * @return String|Boolean  The single post type name or false if not in an single page.
 */
if (!function_exists('getSinglePostType')) {
    function getSinglePostType()
    {
        return is_single() ? get_post_type() : false;
    }
}

/**
 * Get Post by Slug / Path
 */
if (!function_exists('getPostBySlug')) {
    function getPostBySlug($slug, $postType)
    {
        return get_page_by_path($slug, OBJECT, $postType);
    }
}

/**
 * Get Post Featured Image
 */
if (!function_exists('getPostFeaturedImage')) {
    function getPostFeaturedImage($id)
    {
        return wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
    }
}

/**
 * Get Post Category
 */
if (!function_exists('getPostCategory')) {
    function getPostCategory($taxonomy, $id)
    {
        $term_list = wp_get_post_terms($id, $taxonomy, array('fields' => 'ids'));
        $category = get_term_by('id', $term_list[0], $taxonomy);
        return $category;
    }
}

/**
 * Get Post Type Archive Link
 */
if (!function_exists('getArchiveLink')) {
    function getArchiveLink($postType)
    {
        return get_post_type_archive_link($postType);
    }
}

/**
 * Get Taxonomy Terms/Categories
 */
if (!function_exists('getCategories')) {
    function getCategories($taxonomy)
    {
        return get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        ]);
    }
}

/**
 * Get Category
 */
if (!function_exists('getCategory')) {
    function getCategory($categorySlug, $taxonomy)
    {
        return get_term_by('slug', $categorySlug, $taxonomy);
    }
}

/**
 * Get Posts by Category
 */
if (!function_exists('getPostsByCategory')) {
    function getPostsByCategory($post_type, $taxonomy, $category, $limit = -1)
    {
        $query =  new WP_Query([
            'post_type' => $post_type,
            'posts_per_page' => $limit,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $category->term_id
                ),
            )
        ]);

        return $query;
    }
}

/**
 * Get Post Child Posts
 */
if (!function_exists('getChildPosts')) {
    function getChildPosts($post_type, $parentId, $limit = -1)
    {
        $query =  new WP_Query([
            'post_type'      => $post_type,
            'posts_per_page' => $limit,
            'post_parent'    => $parentId,
            'order'          => 'ASC',
        ]);

        return $query;
    }
}

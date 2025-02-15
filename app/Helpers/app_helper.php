<?php

/**
 * Generates breadcrumb HTML based on an array of links.
 *
 * @param {Array<{ title: string, url?: string }>} links - An array of link objects.
 * Each link object should have a 'title' property representing the link text,
 * and an optional 'url' property representing the link URL.
 * @returns {string} The HTML representation of the breadcrumbs.
 */
if (!function_exists('generateBreadcrumb')) {
    function generateBreadcrumb($links)
    {
        $output = '<ol class="breadcrumb mb-4 mt-2">';
        foreach ($links as $link) {
            if (isset($link['url']) && !empty($link['url'])) {
                $output .= '<li class="breadcrumb-item"><a href="' . base_url($link['url']) . '">' . $link['title'] . '</a></li>';
            } else {
                $output .= '<li class="breadcrumb-item active">' . $link['title'] . '</li>';
            }
        }
        $output .= '</ol>';
        return $output;
    }
}
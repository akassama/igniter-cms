<?php
/**
 * Renders a navigation item with optional dropdown for child items.
 * Matches the specific structure: clickable parent, clean dropdown attributes.
 *
 * @param array $navigation The navigation item to render.
 * @param object $navigationsModel The model to query child navigations.
 * @return string The HTML for the navigation item.
 */
function themef_renderNavigation(array $navigation, object $navigationsModel): string
{
    // Extract navigation data
    $navigationId = $navigation['navigation_id'];
    $navTitle = $navigation['title'];
    $parent = $navigation['parent'];
    $link = getLinkUrl($navigation['link']);
    $newTab = $navigation['new_tab'];
    $navTarget = $newTab === "1" ? "_blank" : "_self";

    // Skip if this is a child item (we only render top-level items here)
    if (!empty($parent)) {
        return '';
    }

    // Fetch child navigations
    $childNavigations = $navigationsModel->where('parent', $navigationId)
                                        ->orderBy('order', 'ASC')
                                        ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
                                        ->findAll();

    // Render navigation item
    if (empty($childNavigations)) {
        // Single link without children
        return '
        <li class="nav-item">
            <a class="nav-link" href="' . $link . '" target="' . $navTarget . '">
                ' . $navTitle . '
            </a>
        </li>';
    } else {
        // Link with dropdown
        // Note: href uses $link so the parent is clickable, and we removed id/aria-expanded
        $dropdown = '
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="' . $link . '" role="button" data-bs-toggle="dropdown">
                ' . $navTitle . '
            </a>
            <ul class="dropdown-menu">';

        // Add child items to the dropdown
        foreach ($childNavigations as $childNav) {
            $childLink = getLinkUrl($childNav['link']);
            $childTarget = $childNav['new_tab'] === "1" ? "_blank" : "_self";
            $dropdown .= '
            <li>
                <a class="dropdown-item" href="' . $childLink . '" target="' . $childTarget . '">
                    ' . $childNav['title'] . '
                </a>
            </li>';
        }

        $dropdown .= '
            </ul>
        </li>';

        return $dropdown;
    }
}
?>
<?php
/**
 * Renders a navigation item with optional dropdown for child items.
 * Matches BrighterWeb navigation style with proper dropdown handling.
 *
 * @param array $navigation The navigation item to render.
 * @param object $navigationsModel The model to query child navigations.
 * @param bool $isChild Whether this is a child item in a dropdown.
 * @return string The HTML for the navigation item.
 */
function themef_renderNavigation(array $navigation, object $navigationsModel, bool $isChild = false): string
{
    // Extract navigation data
    $navigationId = $navigation['navigation_id'];
    $navTitle = $navigation['title'];
    $parent = $navigation['parent'];
    $link = getLinkUrl($navigation['link']);
    $newTab = $navigation['new_tab'];
    $navTarget = $newTab === "1" ? "_blank" : "_self";
    
    // Get current URL for active state
    $currentUrl = current_url();
    $isActive = ($currentUrl == rtrim($link, '/')) ? 'active' : '';

    // If this is a child item being rendered recursively, handle differently
    if ($isChild) {
        return '
            <li>
                <a class="dropdown-item ' . $isActive . '" href="' . $link . '" target="' . $navTarget . '">
                    ' . $navTitle . '
                </a>
            </li>';
    }

    // Skip if this is a child item (they are handled in the parent's recursive call)
    if (!empty($parent)) {
        return '';
    }

    // Fetch child navigations
    $childNavigations = $navigationsModel->where('parent', $navigationId)
                                        ->orderBy('order', 'ASC')
                                        ->findAll();

    // Render navigation item
    if (empty($childNavigations)) {
        // Single link without children
        return '
        <li class="nav-item">
            <a class="nav-link ' . $isActive . '" href="' . $link . '" target="' . $navTarget . '">
                ' . $navTitle . '
            </a>
        </li>';
    } else {
        // Link with dropdown - using Bootstrap 5 dropdown with proper caret
        $dropdown = '
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ' . $isActive . '" href="#" id="navbarDropdown-' . $navigationId . '" 
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ' . $navTitle . ' <i class="ri-arrow-down-s-line"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown-' . $navigationId . '">';

        // Add child items to the dropdown recursively
        foreach ($childNavigations as $childNav) {
            // Check if child has its own children (nested dropdown)
            $grandChildren = $navigationsModel->where('parent', $childNav['navigation_id'])
                                             ->orderBy('order', 'ASC')
                                             ->findAll();
            
            if (!empty($grandChildren)) {
                // Nested dropdown (dropdown-submenu)
                $dropdown .= '
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="' . getLinkUrl($childNav['link']) . '" 
                       target="' . ($childNav['new_tab'] === "1" ? "_blank" : "_self") . '"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        ' . $childNav['title'] . ' <i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="dropdown-menu">';
                
                foreach ($grandChildren as $grandChild) {
                    $grandChildLink = getLinkUrl($grandChild['link']);
                    $grandChildTarget = $grandChild['new_tab'] === "1" ? "_blank" : "_self";
                    $grandChildActive = ($currentUrl == rtrim($grandChildLink, '/')) ? 'active' : '';
                    
                    $dropdown .= '
                        <li>
                            <a class="dropdown-item ' . $grandChildActive . '" 
                               href="' . $grandChildLink . '" 
                               target="' . $grandChildTarget . '">
                                ' . $grandChild['title'] . '
                            </a>
                        </li>';
                }
                
                $dropdown .= '
                    </ul>
                </li>';
            } else {
                // Regular dropdown item
                $childLink = getLinkUrl($childNav['link']);
                $childTarget = $childNav['new_tab'] === "1" ? "_blank" : "_self";
                $childActive = ($currentUrl == rtrim($childLink, '/')) ? 'active' : '';
                
                $dropdown .= '
                <li>
                    <a class="dropdown-item ' . $childActive . '" href="' . $childLink . '" target="' . $childTarget . '">
                        ' . $childNav['title'] . '
                    </a>
                </li>';
            }
        }

        $dropdown .= '
            </ul>
        </li>';

        return $dropdown;
    }
}

/**
 * Renders the complete navigation menu with all items
 * 
 * @param array $topNavLists Array of top-level navigation items
 * @param object $navigationsModel The navigation model
 * @return string Complete navigation HTML
 */
function themef_renderCompleteNavigation(array $topNavLists, object $navigationsModel): string
{
    $html = '';
    
    if ($topNavLists) {
        foreach ($topNavLists as $navigation) {
            $html .= themef_renderNavigation($navigation, $navigationsModel);
        }
    }
    
    return $html;
}
?>
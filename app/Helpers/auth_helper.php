<?php

/**
 * Checks if a user has a specific role.
 *
 * @param string $userEmail The user's email address.
 * @param string $role The role to check for.
 * @return boolean True if the user has the role, false otherwise.
 */
if(!function_exists('userHasRole')) {
    function userHasRole($userEmail, $role)
    {
        //user role
        $userRole = getUserRole($userEmail);

        if ($userRole == $role) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Gets the role of a user based on their email or username.
 *
 * @param string $userEmailOrUsername The user's email or username.
 * @return string|null The user's role, or null if not found.
 */
if (!function_exists('getUserRole')) {
    function getUserRole($userEmailOrUsername) {
        $db = \Config\Database::connect();

        //check if is UUID
        if(isValidGUID($userEmailOrUsername)){
            //get user email
            $userEmailOrUsername = getTableData("users", ['user_id' => $userEmailOrUsername], "email");
        }

        $column = isEmail($userEmailOrUsername) ? 'email' : 'username';

        $query = $db->table('users')
            ->select('role')
            ->where($column, $userEmailOrUsername)
            ->get();

        return $query->getNumRows() > 0 ? $query->getRow()->role : null;
    }
}

/**
 * Gets the status of a user based on their email or username.
 *
 * @param string $userEmailOrUsername The user's email or username.
 * @return string|null The user's status, or null if not found.
 */
if (!function_exists('getUserStatus')) {
    function getUserStatus($userEmailOrUsername) {
        $db = \Config\Database::connect();

        $column = isEmail($userEmailOrUsername) ? 'email' : 'username';

        $query = $db->table('users')
            ->select('status')
            ->where($column, $userEmailOrUsername)
            ->get();

        return $query->getNumRows() > 0 ? $query->getRow()->status : null;
    }
}

/**
 * Check if the given text is a valid email address.
 *
 * @param string $text The text to check.
 * @return bool True if the text is a valid email address, false otherwise.
 */
function isEmail($text) {
    return filter_var($text, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Check if the given string is a valid URL.
 *
 * @param string $url The string to check.
 * @return bool True if the string is a valid URL, false otherwise.
 */
function isUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

/**
 * Check if the given value is a number.. Uses php's is_numeric function
 *
 * @param mixed $value The value to check.
 * @return bool True if the value is a number, false otherwise.
 */
function isNumber($value) {
    return is_numeric($value);
}

/**
 * Check if the given value is an integer.
 *
 * @param mixed $value The value to check.
 * @return bool True if the value is an integer, false otherwise.
 */
function isInteger($value) {
    return filter_var($value, FILTER_VALIDATE_INT) !== false;
}

/**
 * Check if the given value is a string. Uses php's is_string function
 *
 * @param mixed $value The value to check.
 * @return bool True if the value is a string, false otherwise.
 */
function isString($value) {
    return is_string($value);
}

/**
 * Check if the given value is a valid date.
 *
 * @param string $date The value to check.
 * @return bool True if the value is a valid date, false otherwise.
 */
function isDate($date) {
    return (bool)strtotime($date);
}

/**
 * Gets the HTML label for a user's status.
 *
 * @param string $status The user's status.
 * @return string The HTML label for the status.
 */
if (!function_exists('getUserStatusLabel')) {
    function getUserStatusLabel($status) {
        if($status == '0'){
            return "<span class='badge bg-secondary'>Inactive</span>";
        }
        else if($status == '1'){
            return "<span class='badge bg-success'>Active</span>";
        }
        else if($status == '2'){
            return "<span class='badge bg-danger'>Closed</span>";
        }
        else {
            return "<span class='badge bg-danger'>NA</span>";
        }
    }
}

/**
 * Gets the plain text status of a user.
 *
 * @param string $status The user's status.
 * @return string The plain text status.
 */
if (!function_exists('getUserStatusOnly')) {
    function getUserStatusOnly($status) {
        if($status == '0'){
            return "Inactive";
        }
        else if($status == '1'){
            return "Active";
        }
        else if($status == '2'){
            return "Closed";
        }
        else {
            return "NA";
        }
    }
}
?>

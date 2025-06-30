<?php
// Get the current URL
$currentUrl = current_url();
$isPasswordChangeURL = strtolower($currentUrl) == strtolower(base_url('/account/settings/change-password'));
//check if password change is required
if(passwordChangeRequired() && !$isPasswordChangeURL && !boolval(env('DEMO_MODE', "false"))){
    $changePasswordTextLink = strtolower(base_url('/account/settings/change-password'));
    $changePasswordTextLink = strtolower($currentUrl) == $changePasswordTextLink ? "" : "<a href='".$changePasswordTextLink."'>Chnage Password Here</a>";
    $passwordResetRequiredMsg = config('CustomConfig')->passwordResetRequiredMsg;
    echo "<div class='alert alert-danger mt-2'>".$passwordResetRequiredMsg." ".$changePasswordTextLink."</div>";
}
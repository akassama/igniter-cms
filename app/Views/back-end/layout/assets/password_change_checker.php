<?php
// Get the current URL
$currentUrl = current_url();
$isPasswordChangeURL = strtolower($currentUrl) == strtolower(base_url('/account/settings/change-password'));
//check if password change is required
if(passwordChangeRequired() && !$isPasswordChangeURL && !boolval(env('DEMO_MODE', "false"))){
    $changePasswordTextLink = strtolower(base_url('/account/settings/change-password'));
    $changePasswordTextLink = strtolower($currentUrl) == $changePasswordTextLink ? "" : "<a href='".$changePasswordTextLink."'>".lang('App.change_password_here')."</a>";
    $passwordResetRequiredMsg = lang('App.password_reset_req_msg');
    echo "<div class='alert alert-danger mt-2'>".$passwordResetRequiredMsg." ".$changePasswordTextLink."</div>";
}
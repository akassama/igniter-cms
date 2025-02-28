<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit Popup<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Popups', 'url' => '/account/cms/popups'),
    array('title' => 'Edit Popup')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit Popup</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/popups/edit-popup'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="name" class="form-label">
                    Name
                    <small>(Readonly)</small>
                </label>
                <input type="text" class="form-control" id="name" name="name" maxlength="250" value="<?= $popup_data['name'] ?>" readonly required>
                <!-- Error -->
                <?php if($validation->getError('name')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('name'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide name
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="type" class="form-label">
                    Type
                    <small>(Readonly)</small>
                </label>
                <input type="text" class="form-control" id="type" name="type" maxlength="250" value="<?= $popup_data['type'] ?>" readonly required>
                <!-- Error -->
                <?php if($validation->getError('type')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('type'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide type
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" maxlength="250" value="<?= $popup_data['title'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('title')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('title'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide title
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea rows="1" class="form-control" id="text" name="text" maxlength="1000"><?= $popup_data['text'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('text')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('text'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide text
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Advert image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="image" name="image" maxlength="250" placeholder="select featured image" value="<?= $popup_data['image'] ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, load, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML">
                            <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#imageFilesModal">
                                <i class="ri-image-fill"></i>
                            </button>
                            <div class="invalid-feedback">
                                Please provide featured image
                            </div>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('image')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('image'); ?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="button_text" class="form-label">Button Text</label>
                <input type="text" class="form-control" id="button_text" name="button_text" maxlength="250" value="<?= $popup_data['button_text'] ?>">
                <!-- Error -->
                <?php if($validation->getError('button_text')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('button_text'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide button_text
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="button_color" class="form-label">Button Color</label>
                <input type="color" class="form-control form-control-color" id="button_color" name="button_color" value="<?= $popup_data['button_color'] ?>" title="Choose your color">
                <!-- Error -->
                <?php if($validation->getError('button_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('button_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide button_color
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="cancel_button_text" class="form-label">Cancel Button Text</label>
                <input type="text" class="form-control" id="cancel_button_text" name="cancel_button_text" maxlength="250" value="<?= $popup_data['cancel_button_text'] ?>">
                <!-- Error -->
                <?php if($validation->getError('cancel_button_text')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('cancel_button_text'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide cancel_button_text
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="cancel_button_color" class="form-label">Cancel Button Color</label>
                <input type="color" class="form-control form-control-color" id="cancel_button_color" name="cancel_button_color" value="<?= $popup_data['cancel_button_color'] ?>" title="Choose your color">
                <!-- Error -->
                <?php if($validation->getError('cancel_button_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('cancel_button_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide cancel_button_color
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="link" class="form-label">
                            Link
                            <span class="small text-muted">(Use '/' for internal links)</span>
                        </label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= $popup_data['link'] ?>">
                        <!-- Error -->
                        <?php if($validation->getError('link')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('link'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide link
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label for="new_tab" class="form-label">New Tab</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab" value="1" <?= ($popup_data['new_tab'] == '1') ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="new_tab">Toggle to open as new tab</label>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('new_tab')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('new_tab'); ?>
                            </div>
                        <?php }?>
                        <div class="invalid-feedback">
                            Please provide new_tab
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="delay" class="form-label">Delay <small>(miliseconds)</small></label>
                <input type="text" class="form-control integer-plus-only" id="delay" name="delay" data-show-err="true" maxlength="6" value="<?= $popup_data['delay'] ?>">
                <!-- Error -->
                <?php if($validation->getError('delay')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('delay'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide delay
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="background_color" class="form-label">Background Color</label>
                <input type="color" class="form-control form-control-color" id="background_color" name="background_color" value="<?= $popup_data['background_color'] ?>" title="Choose your color">
                <!-- Error -->
                <?php if($validation->getError('background_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('background_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide background_color
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="text_color" class="form-label">Text Color</label>
                <input type="color" class="form-control form-control-color" id="text_color" name="text_color" value="<?= $popup_data['text_color'] ?>" title="Choose your color">
                <!-- Error -->
                <?php if($validation->getError('text_color')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('text_color'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide text_color
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="backdrop_opacity" class="form-label">Backdrop Opacity</label>
                <input type="text" class="form-control float-number" id="backdrop_opacity" name="backdrop_opacity" data-show-err="true" maxlength="6" value="<?= $popup_data['backdrop_opacity'] ?>">
                <!-- Error -->
                <?php if($validation->getError('backdrop_opacity')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('backdrop_opacity'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide backdrop_opacity
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="width" class="form-label">Width</label>
                <input type="text" class="form-control integer-plus-only" id="width" name="width" data-show-err="true" maxlength="6" value="<?= $popup_data['width'] ?>">
                <!-- Error -->
                <?php if($validation->getError('width')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('width'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide width
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="text" class="form-control integer-plus-only" id="height" name="height" data-show-err="true" maxlength="6" value="<?= $popup_data['height'] ?>">
                <!-- Error -->
                <?php if($validation->getError('height')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('height'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide height
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="position" class="form-label">Position</label>
                <select class="form-select" id="position" name="position">
                    <option value="">Select position</option>
                    <option value="top" <?= ($popup_data['position'] == 'top') ? 'selected' : '' ?>>top</option>
                    <option value="bottom" <?= ($popup_data['position'] == 'bottom') ? 'selected' : '' ?>>bottom</option>
                    <option value="center" <?= ($popup_data['position'] == 'center') ? 'selected' : '' ?>>center</option>
                    <option value="static" <?= ($popup_data['position'] == 'static') ? 'selected' : '' ?>>static</option>
                    <option value="relative" <?= ($popup_data['position'] == 'relative') ? 'selected' : '' ?>>relative</option>
                    <option value="absolute" <?= ($popup_data['position'] == 'absolute') ? 'selected' : '' ?>>absolute</option>
                    <option value="fixed" <?= ($popup_data['position'] == 'fixed') ? 'selected' : '' ?>>fixed</option>
                    <option value="sticky" <?= ($popup_data['position'] == 'sticky') ? 'selected' : '' ?>>sticky</option>
                    <option value="inherit" <?= ($popup_data['position'] == 'inherit') ? 'selected' : '' ?>>inherit</option>
                    <option value="initial" <?= ($popup_data['position'] == 'initial') ? 'selected' : '' ?>>initial</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('position')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('position'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide position
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="position" class="form-label">Animation (SweetAlert2)</label>
                <select class="form-select" id="animation" name="animation">
                    <option value="">Select animation</option>
                    <option value="animate__fadeIn" <?= ($popup_data['animation'] == 'animate__fadeIn') ? 'selected' : '' ?>>fadeIn</option>
                    <option value="animate__fadeInUp" <?= ($popup_data['animation'] == 'animate__fadeInUp') ? 'selected' : '' ?>>fadeInUp</option>
                    <option value="animate__fadeInDown" <?= ($popup_data['animation'] == 'animate__fadeInDown') ? 'selected' : '' ?>>fadeInDown</option>
                    <option value="animate__fadeInLeft" <?= ($popup_data['animation'] == 'animate__fadeInLeft') ? 'selected' : '' ?>>fadeInLeft</option>
                    <option value="animate__fadeInRight" <?= ($popup_data['animation'] == 'animate__fadeInRight') ? 'selected' : '' ?>>fadeInRight</option>
                    <option value="animate__fadeInUpBig" <?= ($popup_data['animation'] == 'animate__fadeInUpBig') ? 'selected' : '' ?>>fadeInUpBig</option>
                    <option value="animate__fadeInDownBig" <?= ($popup_data['animation'] == 'animate__fadeInDownBig') ? 'selected' : '' ?>>fadeInDownBig</option>
                    <option value="animate__fadeInLeftBig" <?= ($popup_data['animation'] == 'animate__fadeInLeftBig') ? 'selected' : '' ?>>fadeInLeftBig</option>
                    <option value="animate__fadeInRightBig" <?= ($popup_data['animation'] == 'animate__fadeInRightBig') ? 'selected' : '' ?>>fadeInRightBig</option>
                    <option value="animate__bounceIn" <?= ($popup_data['animation'] == 'animate__bounceIn') ? 'selected' : '' ?>>bounceIn</option>
                    <option value="animate__bounceInUp" <?= ($popup_data['animation'] == 'animate__bounceInUp') ? 'selected' : '' ?>>bounceInUp</option>
                    <option value="animate__bounceInDown" <?= ($popup_data['animation'] == 'animate__bounceInDown') ? 'selected' : '' ?>>bounceInDown</option>
                    <option value="animate__bounceInLeft" <?= ($popup_data['animation'] == 'animate__bounceInLeft') ? 'selected' : '' ?>>bounceInLeft</option>
                    <option value="animate__bounceInRight" <?= ($popup_data['animation'] == 'animate__bounceInRight') ? 'selected' : '' ?>>bounceInRight</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('position')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('position'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide position
                </div>
            </div>

            <div class="col-sm-12 col-md-3 mb-3">
                <label for="show_close_button" class="form-label">Show Close Button</label>
                <select class="form-select" id="show_close_button" name="show_close_button">
                    <option value="">Select option</option>
                    <option value="0" <?= ($popup_data['show_close_button'] == '0') ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= ($popup_data['show_close_button'] == '1') ? 'selected' : '' ?>>Yes</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('show_close_button')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('show_close_button'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide show_close_button
                </div>
            </div>

            <?php
                if($popup_data['type'] == '1' || $popup_data['type'] == '5' || $popup_data['type'] == '8'){
                    ?>
                        <hr>
                        <!--Email subscription related fields-->
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="enable_subscription" class="form-label">Enable Subscription</label>
                            <select class="form-select" id="enable_subscription" name="enable_subscription">
                                <option value="">Select option</option>
                                <option value="0" <?= ($popup_data['enable_subscription'] == '0') ? 'selected' : '' ?>>No</option>
                                <option value="1" <?= ($popup_data['enable_subscription'] == '1') ? 'selected' : '' ?>>Yes</option>
                            </select>
                            <!-- Error -->
                            <?php if($validation->getError('enable_subscription')) {?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('enable_subscription'); ?>
                                </div>
                            <?php }?>
                            <div class="invalid-feedback">
                                Please provide enable_subscription
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="subscription_placeholder" class="form-label">Subscription Placeholder</label>
                            <input type="text" class="form-control" id="subscription_placeholder" name="subscription_placeholder" maxlength="250" value="<?= $popup_data['subscription_placeholder'] ?>">
                            <!-- Error -->
                            <?php if($validation->getError('subscription_placeholder')) {?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('subscription_placeholder'); ?>
                                </div>
                            <?php }?>
                            <div class="invalid-feedback">
                                Please provide subscription_placeholder
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="subscription_success_message" class="form-label">Subscription Success Message</label>
                            <input type="text" class="form-control" id="subscription_success_message" name="subscription_success_message" maxlength="250" value="<?= $popup_data['subscription_success_message'] ?>">
                            <!-- Error -->
                            <?php if($validation->getError('subscription_success_message')) {?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('subscription_success_message'); ?>
                                </div>
                            <?php }?>
                            <div class="invalid-feedback">
                                Please provide subscription_success_message
                            </div>
                        </div>
                    <?php
                }
            ?>

            <?php
                if($popup_data['type'] == '7' || $popup_data['type'] == '6'){
                    ?>
                        <hr>
                        <!--Countdown timer related fields-->
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="enable_countdown" class="form-label">Enable Countdown</label>
                            <select class="form-select" id="enable_countdown" name="enable_countdown">
                                <option value="">Select option</option>
                                <option value="0" <?= ($popup_data['enable_countdown'] == '0') ? 'selected' : '' ?>>No</option>
                                <option value="1" <?= ($popup_data['enable_countdown'] == '1') ? 'selected' : '' ?>>Yes</option>
                            </select>
                            <!-- Error -->
                            <?php if($validation->getError('enable_countdown')) {?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('enable_countdown'); ?>
                                </div>
                            <?php }?>
                            <div class="invalid-feedback">
                                Please provide enable_countdown
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="countdown_end_date" class="form-label">Countdown End Date</label>
                            <input type="text" class="form-control" id="countdown_end_date" name="countdown_end_date" maxlength="250" value="<?= $popup_data['countdown_end_date'] ?>">
                            <!-- Error -->
                            <?php if($validation->getError('countdown_end_date')) {?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('countdown_end_date'); ?>
                                </div>
                            <?php }?>
                            <div class="invalid-feedback">
                                Please provide countdown_end_date
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="countdown_format" class="form-label">Countdown Format</label>
                            <input type="text" class="form-control" id="countdown_format" name="countdown_format" maxlength="250" value="<?= $popup_data['countdown_format'] ?>">
                            <!-- Error -->
                            <?php if($validation->getError('countdown_format')) {?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('countdown_format'); ?>
                                </div>
                            <?php }?>
                            <div class="invalid-feedback">
                                Please provide countdown_format
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="countdown_expired_text" class="form-label">Countdown Expired Text</label>
                            <input type="text" class="form-control" id="countdown_expired_text" name="countdown_expired_text" maxlength="250" value="<?= $popup_data['countdown_expired_text'] ?>">
                            <!-- Error -->
                            <?php if($validation->getError('countdown_expired_text')) {?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('countdown_expired_text'); ?>
                                </div>
                            <?php }?>
                            <div class="invalid-feedback">
                                Please provide countdown_expired_text
                            </div>
                        </div>
                    <?php
                }
            ?>

            <hr>
            <!--// General fields-->
            <div class="col-sm-12 col-md-4 mb-3">
                <label for="frequency" class="form-label">Frequency (Days)</label>
                <select class="form-select" id="frequency" name="frequency">
                    <option value="">Select option</option>
                    <option value="0.25" <?= ($popup_data['frequency'] == '0.25') ? 'selected' : '' ?>>0.25</option>
                    <option value="0.50" <?= ($popup_data['frequency'] == '0.50') ? 'selected' : '' ?>>0.50</option>
                    <option value="1" <?= ($popup_data['frequency'] == '1') ? 'selected' : '' ?>>1</option>
                    <option value="2" <?= ($popup_data['frequency'] == '2') ? 'selected' : '' ?>>2</option>
                    <option value="3" <?= ($popup_data['frequency'] == '3') ? 'selected' : '' ?>>3</option>
                    <option value="5" <?= ($popup_data['frequency'] == '5') ? 'selected' : '' ?>>5</option>
                    <option value="7" <?= ($popup_data['frequency'] == '7') ? 'selected' : '' ?>>7</option>
                    <option value="10" <?= ($popup_data['frequency'] == '10') ? 'selected' : '' ?>>10</option>
                    <option value="20" <?= ($popup_data['frequency'] == '20') ? 'selected' : '' ?>>20</option>
                    <option value="30" <?= ($popup_data['frequency'] == '30') ? 'selected' : '' ?>>30</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('frequency')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('frequency'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide frequency
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" maxlength="6" value="<?= $popup_data['order'] ?>">
                <!-- Error -->
                <?php if($validation->getError('order')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('order'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide order
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Select status</option>
                    <option value="0" <?= ($popup_data['status'] == '0') ? 'selected' : '' ?>>Unpublished</option>
                    <option value="1" <?= ($popup_data['status'] == '1') ? 'selected' : '' ?>>Published</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('status')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('status'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide status
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="show_on_pages" class="form-label">Show on Pages: </label>

                <?php if($validation->getError('show_on_pages')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('show_on_pages'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide show_on_pages
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="home" id="home" name="show_on_pages" <?= strpos($popup_data['show_on_pages'], "home") !== false ? "checked" : "" ?>>
                    <label class="form-check-label" for="home">Home</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="blogs" id="blogs" name="show_on_pages" <?= strpos($popup_data['show_on_pages'], "blogs") !== false ? "checked" : "" ?>>
                    <label class="form-check-label" for="blogs">Blogs</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="pages" id="pages" name="show_on_pages" <?= strpos($popup_data['show_on_pages'], "pages") !== false ? "checked" : "" ?>>
                    <label class="form-check-label" for="pages">Pages</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="shop" id="shop" name="show_on_pages" <?= strpos($popup_data['show_on_pages'], "shop") !== false ? "checked" : "" ?>>
                    <label class="form-check-label" for="shop">Shop</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="contact" id="contact" name="show_on_pages" <?= strpos($popup_data['show_on_pages'], "contact") !== false ? "checked" : "" ?>>
                    <label class="form-check-label" for="contact">Contact</label>
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="popup_id" name="popup_id" value="<?= $popup_data['popup_id']; ?>" />
                <input type="hidden" class="form-control" id="deletable" name="deletable" value="<?= $popup_data['deletable']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $popup_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
            <a href="<?= base_url('/account/cms/popups') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
                    <i class="ri-edit-box-line"></i>
                    Update
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>

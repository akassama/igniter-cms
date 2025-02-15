<?php
    $whereClause = ['status' => 1];
    $popupId = getTableData('announcement_popups', $whereClause, 'popup_id');
    $name = getTableData('announcement_popups', $whereClause, 'name');
    $type = getTableData('announcement_popups', $whereClause, 'type');
    $title = getTableData('announcement_popups', $whereClause, 'title');
    $text = getTableData('announcement_popups', $whereClause, 'text');
    $button_text = getTableData('announcement_popups', $whereClause, 'button_text');
    $button_color = getTableData('announcement_popups', $whereClause, 'button_color');
    $cancel_button_text = getTableData('announcement_popups', $whereClause, 'cancel_button_text');
    $cancel_button_color = getTableData('announcement_popups', $whereClause, 'cancel_button_color');
    $link = getTableData('announcement_popups', $whereClause, 'link');
    $new_tab = getTableData('announcement_popups', $whereClause, 'new_tab');
    $delay = getTableData('announcement_popups', $whereClause, 'delay') ?? 2000;
    $image = getTableData('announcement_popups', $whereClause, 'image');
    $background_color = getTableData('announcement_popups', $whereClause, 'background_color');
    $text_color = getTableData('announcement_popups', $whereClause, 'text_color');
    $backdrop_opacity = getTableData('announcement_popups', $whereClause, 'backdrop_opacity');
    $width = getTableData('announcement_popups', $whereClause, 'width');
    $height = getTableData('announcement_popups', $whereClause, 'height');
    $position = getTableData('announcement_popups', $whereClause, 'position');
    $animation = getTableData('announcement_popups', $whereClause, 'animation');
    $show_close_button = getTableData('announcement_popups', $whereClause, 'show_close_button') ?? 1;
    $enable_subscription = getTableData('announcement_popups', $whereClause, 'enable_subscription');
    $subscription_placeholder = getTableData('announcement_popups', $whereClause, 'subscription_placeholder');
    $subscription_success_message = getTableData('announcement_popups', $whereClause, 'subscription_success_message');
    $enable_countdown = getTableData('announcement_popups', $whereClause, 'enable_countdown');
    $countdown_end_date = getTableData('announcement_popups', $whereClause, 'countdown_end_date');
    $countdown_format = getTableData('announcement_popups', $whereClause, 'countdown_format');
    $countdown_expired_text = getTableData('announcement_popups', $whereClause, 'countdown_expired_text');
    $frequency = getTableData('announcement_popups', $whereClause, 'frequency') ?? 7;
    $show_on_pages = getTableData('announcement_popups', $whereClause, 'show_on_pages');

    // Initialize cookie variables
    $cookie_name = "popup_advert_cookie";
    $stored_popup_id = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : null;

    // Show popup only if:
    // 1. We have a valid popup ID
    // 2. Either no cookie is set OR the stored popup ID is different from current popup ID
    $should_show_popup = $popupId && 
                        (!$stored_popup_id || $stored_popup_id !== $popupId) && 
                        !empty($title) && 
                        !empty($image);

    if($should_show_popup) {
        ?>
            <script>
                // Get the database record
                const popupData = {
                    "popup_id": "<?=$popupId?>",
                    "name": "<?=$name?>",
                    "type": <?=$type?>,
                    "title": "<?=$title?>",
                    "text": "<?=$text?>",
                    "button_text": "<?=$button_text?>",
                    "button_color": "<?=$button_color?>",
                    "cancel_button_text": "<?=$cancel_button_text?>",
                    "cancel_button_color": "<?=$cancel_button_color?>",
                    "link": "<?=$link?>",
                    "new_tab": <?=$new_tab?>,
                    "delay": <?=$delay?>,
                    "image": "<?=$image?>",
                    "background_color": "<?=$background_color?>",
                    "text_color": "<?=$text_color?>",
                    "backdrop_opacity": <?=$backdrop_opacity?>,
                    "width": <?=$width?>,
                    "height": <?=$height?>,
                    "position": "<?=$position?>",
                    "animation": "<?=$animation?>",
                    "show_close_button": <?=$show_close_button?>,
                    "enable_subscription": "<?=$enable_subscription?>",
                    "subscription_placeholder": "<?=$subscription_placeholder?>",
                    "subscription_success_message": "<?=$subscription_success_message?>",
                    "enable_countdown": "<?=$enable_countdown?>",
                    "countdown_end_date": "<?=$countdown_end_date?>",
                    "countdown_format": "<?=$countdown_format?>",
                    "countdown_expired_text": "<?=$countdown_expired_text?>",
                    "frequency": "<?=$frequency?>",
                    "show_on_pages": "<?=$show_on_pages?>" 
                };

                //implement logic to show the right popup
                function showPopupByType(popupData) {
                    // Common configuration used across all types
                    const baseConfig = {
                        imageUrl: popupData.image,
                        imageWidth: parseInt(popupData.width),
                        imageHeight: parseInt(popupData.height),
                        width: parseInt(popupData.width),
                        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
                        background: popupData.background_color,
                        backdrop: `rgba(0,0,0,${popupData.backdrop_opacity})`,
                        position: popupData.position,
                        showClass: {
                            popup: `animate__animated ${popupData.animation}`
                        }
                    };

                    switch (parseInt(popupData.type)) {
                        case 1:
                            // Type 1: Image with call-to-action button
                            return Swal.fire({
                                ...baseConfig,
                                title: `<h2 style="color: ${popupData.text_color}">${popupData.title}</h2>`,
                                text: popupData.text,
                                confirmButtonText: popupData.button_text,
                                confirmButtonColor: popupData.button_color,
                                showCancelButton: true,
                                cancelButtonText: popupData.cancel_button_text,
                                cancelButtonColor: popupData.cancel_button_color,
                                preConfirm: () => {
                                    if (parseInt(popupData.new_tab)) {
                                        window.open(popupData.link, '_blank');
                                    } else {
                                        window.location.href = popupData.link;
                                    }
                                }
                            });

                        case 2:
                            // Type 2: Image background with overlay text and CTA
                            return Swal.fire({
                                ...baseConfig,
                                title: `<h2 style="color: ${popupData.text_color}">${popupData.title}</h2>`,
                                html: `<p style="color: ${popupData.text_color}">${popupData.text}</p>`,
                                confirmButtonText: popupData.button_text,
                                confirmButtonColor: popupData.button_color,
                                preConfirm: () => {
                                    if (parseInt(popupData.new_tab)) {
                                        window.open(popupData.link, '_blank');
                                    } else {
                                        window.location.href = popupData.link;
                                    }
                                }
                            });

                        case 3:
                            // Type 3: Image background with subscription form
                            return Swal.fire({
                                ...baseConfig,
                                title: `<h2 style="color: ${popupData.text_color}">${popupData.title}</h2>`,
                                html: `
                                    <p style="color: ${popupData.text_color}">${popupData.text}</p>
                                    <input type="email" id="swal-input1" class="swal2-input" placeholder="${popupData.subscription_placeholder || 'Enter your email'}">
                                `,
                                confirmButtonText: popupData.button_text,
                                confirmButtonColor: popupData.button_color,
                                preConfirm: () => {
                                    const email = document.getElementById('swal-input1').value;
                                    if (!email || !email.includes('@')) {
                                        Swal.showValidationMessage('Please enter a valid email');
                                        return false;
                                    }
                                    return { email: email };
                                }
                            });

                        case 4:
                            // Type 4: Split layout with image and content
                            return Swal.fire({
                                ...baseConfig,
                                html: `
                                    <div style="display: flex; min-height: ${popupData.height}px;">
                                        <div style="flex: 1;">
                                            <img src="${popupData.image}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div style="flex: 1; padding: 2rem; text-align: left;">
                                            <h2 style="color: ${popupData.text_color}">${popupData.title}</h2>
                                            <p style="color: ${popupData.text_color}">${popupData.text}</p>
                                            <button class="swal2-confirm swal2-styled" 
                                                    onclick="window.location.href='${popupData.link}'"
                                                    style="background-color: ${popupData.button_color}">${popupData.button_text}</button>
                                        </div>
                                    </div>
                                `,
                                showConfirmButton: false
                            });

                        case 5:
                            // Type 5: Split layout with subscription form
                            return Swal.fire({
                                ...baseConfig,
                                html: `
                                    <div style="display: flex; min-height: ${popupData.height}px;">
                                        <div style="flex: 1;">
                                            <img src="${popupData.image}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div style="flex: 1; padding: 2rem; text-align: left;">
                                            <h2 style="color: ${popupData.text_color}">${popupData.title}</h2>
                                            <p style="color: ${popupData.text_color}">${popupData.text}</p>
                                            <input type="email" id="swal-input2" class="swal2-input" 
                                                placeholder="${popupData.subscription_placeholder || 'Enter your email'}">
                                            <button class="swal2-confirm swal2-styled" 
                                                    onclick="handleSubscription()"
                                                    style="background-color: ${popupData.button_color}">${popupData.button_text}</button>
                                        </div>
                                    </div>
                                `,
                                showConfirmButton: false
                            });

                        case 6:
                        case 7:
                            // Types 6 & 7: Countdown timer (split or full)
                            let countDown;
                            const endDate = new Date(popupData.countdown_end_date).getTime();
                            const isSplit = parseInt(popupData.type) === 6;

                            const content = isSplit ? `
                                <div style="display: flex; min-height: ${popupData.height}px;">
                                    <div style="flex: 1;">
                                        <img src="${popupData.image}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div style="flex: 1; padding: 2rem; text-align: left;">
                                        <h2 style="color: ${popupData.text_color}">${popupData.title}</h2>
                                        <p style="color: ${popupData.text_color}">${popupData.text}</p>
                                        <div id="countdown" style="font-size: 1.5em; margin: 1rem 0;"></div>
                                        <button class="swal2-confirm swal2-styled" 
                                                onclick="window.location.href='${popupData.link}'"
                                                style="background-color: ${popupData.button_color}">${popupData.button_text}</button>
                                    </div>
                                </div>
                            ` : `
                                <div style="text-align: center;">
                                    <h2 style="color: ${popupData.text_color}">${popupData.title}</h2>
                                    <p style="color: ${popupData.text_color}">${popupData.text}</p>
                                    <div id="countdown" style="font-size: 1.5em; margin: 1rem 0;"></div>
                                </div>
                            `;

                            return Swal.fire({
                                ...baseConfig,
                                html: content,
                                showConfirmButton: !isSplit,
                                confirmButtonText: popupData.button_text,
                                confirmButtonColor: popupData.button_color,
                                didOpen: () => {
                                    countDown = setInterval(() => {
                                        const now = new Date().getTime();
                                        const distance = endDate - now;
                                        
                                        if (distance < 0) {
                                            clearInterval(countDown);
                                            document.getElementById('countdown').innerHTML = 
                                                popupData.countdown_expired_text || "EXPIRED";
                                            return;
                                        }
                                        
                                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                        
                                        document.getElementById('countdown').innerHTML = 
                                            `${days}d ${hours}h ${minutes}m ${seconds}s`;
                                    }, 1000);
                                },
                                willClose: () => {
                                    clearInterval(countDown);
                                }
                            });

                            case 8:
                            // Type 8: Image background with subscription form
                            return Swal.fire({
                                ...baseConfig,
                                title: `<h2 style="color: ${popupData.text_color}">${popupData.title}</h2>`,
                                html: `
                                    <p style="color: ${popupData.text_color}">${popupData.text}</p>
                                    <input type="email" id="swal-input1" class="swal2-input" placeholder="${popupData.subscription_placeholder || 'Enter your email'}">
                                `,
                                confirmButtonText: popupData.button_text,
                                confirmButtonColor: popupData.button_color,
                                preConfirm: () => {
                                    const email = document.getElementById('swal-input1').value;
                                    if (!email || !email.includes('@')) {
                                        Swal.showValidationMessage('Please enter a valid email');
                                        return false;
                                    }
                                    return { email: email };
                                }
                            });

                        default:
                            console.error('Invalid popup type');
                            return null;
                    }
                }

                // Usage:
                // 1. Show popup with delay
                setTimeout(() => {
                    showPopupByType(popupData);
                }, parseInt(popupData.delay));

                // 2. Helper function for subscription handling
                function handleSubscription() {
                    const email = document.getElementById('swal-input2').value;
                    if (!email || !email.includes('@')) {
                        Swal.showValidationMessage('Please enter a valid email');
                        return;
                    }
                    // Handle subscription logic here
                    Swal.fire({
                        title: 'Success!',
                        text: popupData.subscription_success_message || 'Thank you for subscribing!',
                        icon: 'success'
                    });
                }
            </script>
        <?php
        // Set new cookie for $N days
        // $expiration_time = time() + ($frequency * 24 * 60 * 60);
        // setcookie($cookie_name, $popupId, [
        //     'expires' => $expiration_time,
        //     'path' => '/',
        //     'secure' => true,     // Only send over HTTPS
        //     'httponly' => true,   // Not accessible via JavaScript
        //     'samesite' => 'Lax'   // Protect against CSRF
        // ]);
    }
?>
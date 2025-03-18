<?php

$swalLoaded = false; // Assuming SweetAlert2 is not loaded by default

// Check if a variable indicating SweetAlert2 is loaded exists (optional)
if (isset($_SESSION['swalLoaded']) && $_SESSION['swalLoaded'] === true) {
  $swalLoaded = true;
}

// Check if a function from SweetAlert2 exists (alternative approach)
if (function_exists('Swal')) {
  $swalLoaded = true;
}

if (!$swalLoaded) {
  // Include SweetAlert2 if not loaded yet
  echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">';
  echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>';
  echo "<script>console.log('sweetalert2 loaded')</script>";
}

//get popup data
$whereClause = ['status' => 1];
$popupId = getTableData('announcement_popups', $whereClause, 'popup_id');
$name = getTableData('announcement_popups', $whereClause, 'name');
$type = getTableData('announcement_popups', $whereClause, 'type');
$title = getTableData('announcement_popups', $whereClause, 'title') ?? 'Title';
$text = getTableData('announcement_popups', $whereClause, 'text') ?? 'Text';
$button_text = getTableData('announcement_popups', $whereClause, 'button_text') ?? 'Action';
$button_color = getTableData('announcement_popups', $whereClause, 'button_color') ?? '#0484B2';
$cancel_button_text = getTableData('announcement_popups', $whereClause, 'cancel_button_text') ?? 'Title';
$cancel_button_color = getTableData('announcement_popups', $whereClause, 'cancel_button_color') ??  '#d33';
$link = getTableData('announcement_popups', $whereClause, 'link') ?? base_url();
$new_tab = getTableData('announcement_popups', $whereClause, 'new_tab') ?? 1;
$delay = getTableData('announcement_popups', $whereClause, 'delay') ?? 2000;
$imageLink = getTableData('announcement_popups', $whereClause, 'image');
$image =  empty($imageLink) ? getDefaultImagePath() : $imageLink;
$background_color = getTableData('announcement_popups', $whereClause, 'background_color') ?? '#ffffff';
$text_color = getTableData('announcement_popups', $whereClause, 'text_color') ?? '#000000';
$backdrop_opacity = getTableData('announcement_popups', $whereClause, 'backdrop_opacity') ?? 0.7;
$width = getTableData('announcement_popups', $whereClause, 'width') ?? 900;
$height = getTableData('announcement_popups', $whereClause, 'height') ?? 600;
$position = getTableData('announcement_popups', $whereClause, 'position') ?? 'center';
$animation = getTableData('announcement_popups', $whereClause, 'animation') ?? 'animate__fadeIn';
$show_close_button = getTableData('announcement_popups', $whereClause, 'show_close_button') ?? 1;
$enable_subscription = getTableData('announcement_popups', $whereClause, 'enable_subscription');
$subscription_placeholder = getTableData('announcement_popups', $whereClause, 'subscription_placeholder') ?? '';
$subscription_success_message = getTableData('announcement_popups', $whereClause, 'subscription_success_message') ?? 'Subscribed successfully!';
$subscription_url = base_url('/api/add-subscriber');
$enable_countdown = getTableData('announcement_popups', $whereClause, 'enable_countdown') ?? 1;
$countdown_end_date = getTableData('announcement_popups', $whereClause, 'countdown_end_date') ?? date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 3 days'));
$countdown_format = getTableData('announcement_popups', $whereClause, 'countdown_format') ?? '';
$countdown_expired_text = getTableData('announcement_popups', $whereClause, 'countdown_expired_text') ?? '';
$frequency = getTableData('announcement_popups', $whereClause, 'frequency') ?? 7;
$show_on_pages = getTableData('announcement_popups', $whereClause, 'show_on_pages') ?? '';

// Initialize cookie variables
$cookie_name = "popup_advert_cookie";
$stored_popup_id = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : null;
?>

<script>
//type 1 - Image only with call-to-action button
function advertType1(popupData) {
    Swal.fire({
        title: `<h2 style="color: ${popupData.text_color}">${popupData.title}</h2>`,
        html: `<p style="color: ${popupData.text_color}">${popupData.text}</p>`,
        imageUrl: popupData.image,
        imageWidth: parseInt(popupData.width),
        imageHeight: parseInt(popupData.height),
        width: parseInt(popupData.width),
        padding: '2rem',
        background: popupData.background_color,
        backdrop: `rgba(0,0,0,${popupData.backdrop_opacity})`,
        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
        confirmButtonText: popupData.button_text,
        confirmButtonColor: popupData.button_color,
        showCancelButton: true,
        cancelButtonText: popupData.cancel_button_text,
        cancelButtonColor: popupData.cancel_button_color,
        position: popupData.position,
        showClass: {
            popup: `animate__animated ${popupData.animation}`
        },
        preConfirm: () => {
            if (parseInt(popupData.new_tab)) {
                window.open(popupData.link, '_blank');
            } else {
                window.location.href = popupData.link;
            }
        }
    });
}

// Type 2 - Image background with title, description, and CTA button
function advertType2(popupData) {
    Swal.fire({
        title: `<h2 style="color: ${popupData.text_color}">${popupData.title}</h2>`,
        html: `<p style="color: ${popupData.text_color}">${popupData.text}</p>`,
        imageUrl: popupData.image,
        imageWidth: parseInt(popupData.width),
        imageHeight: parseInt(popupData.height),
        width: parseInt(popupData.width),
        background: popupData.background_color,
        backdrop: `rgba(0,0,0,${popupData.backdrop_opacity})`,
        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
        confirmButtonText: popupData.button_text,
        confirmButtonColor: popupData.button_color,
        position: popupData.position,
        showClass: {
            popup: `animate__animated ${popupData.animation}`
        },
        preConfirm: () => {
            if (parseInt(popupData.new_tab)) {
                window.open(popupData.link, '_blank');
            } else {
                window.location.href = popupData.link;
            }
        }
    });
}

// Type 3 - Image background with title, description, email input, and subscribe button
function advertType3(popupData) {
    Swal.fire({
        title: `<h2 style="color: ${popupData.text_color}">${popupData.title}</h2>`,
        html: `
        <p style="color: ${popupData.text_color}; font-size: 1.2em;">${popupData.text}</p>
        <input type="email" id="swal-input1" class="swal2-input" placeholder="${popupData.subscription_placeholder || 'Enter your email'}">
        `,
        imageUrl: popupData.image,
        imageWidth: parseInt(popupData.width),
        imageHeight: parseInt(popupData.height),
        width: parseInt(popupData.width),
        background: popupData.background_color,
        backdrop: `rgba(0,0,0,${popupData.backdrop_opacity})`,
        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
        confirmButtonText: popupData.button_text,
        confirmButtonColor: popupData.button_color,
        showClass: {
            popup: `animate__animated ${popupData.animation}`,
        },
        preConfirm: () => {
            const email = document.getElementById('swal-input1').value;

            // Validate email
            if (!email) {
                Swal.showValidationMessage('Please enter your email');
                return false;
            }

            // Post email to the backend
            return fetch(popupData.subscription_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    email: email,
                }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Failed to subscribe');
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.message) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: popupData.subscription_success_message || data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again.',
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Failed to subscribe. Please check your connection and try again.',
                    });
                });
        },
    });
}

// Type 4 - Split layout with image on left, content on right
function advertType4(popupData) {
    Swal.fire({
        html: `
        <div style="display: flex; min-height: ${popupData.height}px;">
            <div style="flex: 1;">
                <img loading="lazy" src="${popupData.image}" style="width: 100%; height: 100%; object-fit: cover;">
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
        width: parseInt(popupData.width),
        showConfirmButton: false,
        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
        background: popupData.background_color,
        position: popupData.position,
        showClass: {
            popup: `animate__animated ${popupData.animation}`
        }
    });
}

// Type 5 - Split layout with image, email subscription
function advertType5(popupData) {
    Swal.fire({
        html: `
        <div style="display: flex; min-height: ${popupData.height}px;">
            <div style="flex: 1;">
                <img loading="lazy" src="${popupData.image}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="flex: 1; padding: 2rem; text-align: left;">
                <h2 style="color: ${popupData.text_color}; font-size: 2em; margin-bottom: 1rem;">${popupData.title}</h2>
                <p style="color: ${popupData.text_color}; font-size: 1.2em; margin-bottom: 2rem;">${popupData.text}</p>
                <input type="email" id="swal-input2" name="email" class="swal2-input" placeholder="${popupData.subscription_placeholder || 'Enter your email'}">
                <button id="swal-subscribe-button" class="swal2-confirm swal2-styled">Subscribe</button>
            </div>
        </div>
        `,
        width: parseInt(popupData.width),
        showConfirmButton: false,
        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
        background: popupData.background_color,
        didOpen: () => {
            document.getElementById('swal-subscribe-button').addEventListener('click', () => {
                const email = document.getElementById('swal-input2').value;

                // Validate email
                if (!email) {
                    Swal.showValidationMessage('Please enter your email');
                    return;
                }

                // Make AJAX request
                fetch(popupData.subscription_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ email }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.message) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: popupData.subscription_success_message || data.message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An unexpected error occurred. Please try again later.',
                            });
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to subscribe. Please check your connection and try again.',
                        });
                    });
            });
        },
    });
}


// Type 6 - Split layout with countdown
function advertType6(popupData) {
    let countDown;
    const endDate = new Date(popupData.countdown_end_date).getTime();

    Swal.fire({
        html: `
        <div style="display: flex; min-height: ${popupData.height}px;">
            <div style="flex: 1;">
                <img loading="lazy" src="${popupData.image}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="flex: 1; padding: 2rem; text-align: left;">
                <h2 style="color: ${popupData.text_color}">${popupData.title}</h2>
                <p style="color: ${popupData.text_color}">${popupData.text}</p>
                <div id="countdown" style="color: ${popupData.text_color}; font-size: 1.5em; margin-bottom: 2rem;"></div>
                <button class="swal2-confirm swal2-styled" 
                    onclick="window.location.href='${popupData.link}'"
                    style="background-color: ${popupData.button_color}">${popupData.button_text}</button>
            </div>
        </div>
    `,
        width: parseInt(popupData.width),
        showConfirmButton: false,
        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
        background: popupData.background_color,
        preConfirm: () => {
            if (parseInt(popupData.new_tab)) {
                window.open(popupData.link, '_blank');
            } else {
                window.location.href = popupData.link;
            }
        },
        didOpen: () => {
            countDown = setInterval(() => {
                const now = new Date().getTime();
                const distance = endDate - now;

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('countdown').innerHTML =
                    `${days}d ${hours}h ${minutes}m ${seconds}s`;

                if (distance < 0) {
                    clearInterval(countDown);
                    document.getElementById('countdown').innerHTML = "EXPIRED";
                }
            }, 1000);
        },
        willClose: () => {
            clearInterval(countDown);
        }
    });
}

// Type 7 - Full background image with countdown
function advertType7(popupData) {
    let countDown;
    const endDate = new Date().getTime() + (3 * 24 * 60 * 60 * 1000); // 3 days from now

    Swal.fire({
        title: `<h2 style="color: ${popupData.text_color};">${popupData.title}</h2>`,
        html: `
        <p style="color: ${popupData.text_color}; font-size: 1.2em;">${popupData.text}</p>
        <div id="countdown2" style="color: ${popupData.text_color}; font-size: 1.5em; margin: 2rem 0;"></div>
    `,
        imageUrl: popupData.image,
        imageWidth: parseInt(popupData.width),
        imageHeight: parseInt(popupData.height),
        width: parseInt(popupData.width),
        background: popupData.background_color,
        backdrop: `rgba(0,0,0,${popupData.backdrop_opacity})`,
        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
        confirmButtonText: popupData.button_text,
        confirmButtonColor: popupData.button_color,
        preConfirm: () => {
            if (parseInt(popupData.new_tab)) {
                window.open(popupData.link, '_blank');
            } else {
                window.location.href = popupData.link;
            }
        },
        didOpen: () => {
            countDown = setInterval(() => {
                const now = new Date().getTime();
                const distance = endDate - now;

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('countdown2').innerHTML =
                    `${days}d ${hours}h ${minutes}m ${seconds}s`;

                if (distance < 0) {
                    clearInterval(countDown);
                    document.getElementById('countdown2').innerHTML = "EXPIRED";
                }
            }, 1000);
        },
        willClose: () => {
            clearInterval(countDown);
        }
    });
}

// Type 8 - Email input, and subscribe button
function advertType8(popupData) {
    Swal.fire({
        title: `<h2 style="color: ${popupData.text_color}">${popupData.title}</h2>`,
        html: `
        <p style="color: ${popupData.text_color}; font-size: 1.2em;">${popupData.text}</p>
        <input type="email" id="swal-input1" class="swal2-input" placeholder="${popupData.subscription_placeholder || 'Enter your email'}">
        `,
        width: parseInt(popupData.width),
        background: popupData.background_color,
        backdrop: `rgba(0,0,0,${popupData.backdrop_opacity})`,
        showCloseButton: Boolean(parseInt(popupData.show_close_button)),
        confirmButtonText: popupData.button_text,
        confirmButtonColor: popupData.button_color,
        preConfirm: () => {
            const email = document.getElementById('swal-input1').value;

            // Validate email
            if (!email) {
                Swal.showValidationMessage('Please enter your email');
                return false;
            }

            // Post email to the backend
            return fetch(popupData.subscription_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    email: email,
                }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Failed to subscribe');
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.message) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: popupData.subscription_success_message || data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again.',
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Failed to subscribe. Please check your connection and try again.',
                    });
                });
        },
    });
}
</script>

<?php
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
                    "subscription_url": "<?=$subscription_url?>",
                    "enable_countdown": "<?=$enable_countdown?>",
                    "countdown_end_date": "<?=$countdown_end_date?>",
                    "countdown_format": "<?=$countdown_format?>",
                    "countdown_expired_text": "<?=$countdown_expired_text?>",
                    "frequency": "<?=$frequency?>",
                    "show_on_pages": "<?=$show_on_pages?>" 
                };

                //---------------------Implement logic to show the right popup-------------//
                //console.log(popupData);
                setTimeout(function() {
                    //Now switch case to check which popup type to show
                    switch (parseInt(popupData.type)) {
                        case 1:
                            advertType1(popupData);
                            break;
                        case 2:
                            advertType2(popupData);
                            break;
                        case 3:
                            advertType3(popupData);
                            break;
                        case 4:
                            advertType4(popupData);
                            break;
                        case 5:
                            advertType5(popupData);
                            break;
                        case 6:
                            advertType6(popupData);
                            break;
                        case 7:
                            advertType7(popupData);
                            break;
                        case 8:
                            advertType8(popupData);
                            break;
                    }
                }, popupData.delay);

            </script>
        <?php
        // Set new cookie for $N days
        $expiration_time = time() + ($frequency * 24 * 60 * 60);
        setcookie($cookie_name, $popupId, [
            'expires' => $expiration_time,
            'path' => '/',
            'secure' => true,     // Only send over HTTPS
            'httponly' => true,   // Not accessible via JavaScript
            'samesite' => 'Lax'   // Protect against CSRF
        ]);
    }
?>
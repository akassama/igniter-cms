<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>
<!-- begin main content -->
<?= $this->section('content') ?>
<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'AI Helpbot')
);
echo generateBreadcrumb($breadcrumb_links);
?>
<div class="row">
<!-- Chat History -->
<div class="col-md-4 col-lg-3 mb-4">
    <div class="card h-100">
        <div class="card-header">
            <h5 class="card-title">Chat History</h5>
        </div>
        <div class="card-body overflow-auto" style="max-height: 400px;">
            <ul class="list-group list-group-flush" id="chat-history">
                <?php foreach ($chatHistory as $chat): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= esc($chat['chat_title']) ?>
                        <button class="btn btn-sm btn-danger delete-chat" data-chat-id="<?= esc($chat['chat_id']) ?>">Delete</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Main Chat Interface -->
<div class="col-md-8 col-lg-9">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">AI Helpbot</h5>
        </div>
        <div class="card-body">
            <!-- Chat Display Area -->
            <div class="overflow-auto border rounded p-3 mb-3" style="height: 400px;" id="chat-display"></div>

            <!-- Chat Input Form -->
            <form id="chat-form" class="d-flex">
                <input type="hidden" id="chat-id" name="chat_id">
                <input type="text" class="form-control me-2" id="message" placeholder="Type your message..." required>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for AJAX -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const chatForm = document.getElementById('chat-form');
    const chatDisplay = document.getElementById('chat-display');
    const chatIdInput = document.getElementById('chat-id');

    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const messageInput = document.getElementById('message');
        const message = messageInput.value.trim();

        if (!message) return;

        // Disable form while processing
        chatForm.querySelector('button').disabled = true;

        try {
            const response = await fetch('/account/ai-helpbot/send-message', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    message: message,
                    chat_id: chatIdInput.value,
                }),
            });

            const result = await response.json();

            if (result.error) {
                alert(result.error);
            } else {
                // Update chat ID for future messages
                chatIdInput.value = result.chat_id;

                // Append user message and AI response to chat display
                chatDisplay.innerHTML += `
                    <div class="d-flex flex-column mb-2">
                        <div class="alert alert-secondary w-75 text-end">${escapeHtml(result.user_message)}</div>
                    </div>
                    <div class="d-flex flex-column mb-2">
                        <div class="alert alert-primary w-75">${escapeHtml(result.ai_response)}</div>
                    </div>
                `;
                chatDisplay.scrollTop = chatDisplay.scrollHeight;

                // Clear input field
                messageInput.value = '';
            }
        } catch (error) {
            console.error(error);
            alert('An error occurred while sending the message.');
        } finally {
            // Re-enable form
            chatForm.querySelector('button').disabled = false;
        }
    });

    // Helper function to escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});
</script>
</div>

<!-- Include the delete script -->
<?= $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
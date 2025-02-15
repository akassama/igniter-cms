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
    <!-- Left Sidebar: Chat History -->
    <div class="col-md-4 col-lg-3 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title">Chat History</h5>
            </div>
            <div class="card-body overflow-auto" style="max-height: 400px;">
                <ul class="list-group list-group-flush" id="chat-history">
                    <!-- Chat History Items -->
                    <?php if($ai_chats): ?>
                        <?php foreach($ai_chats as $chat): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#!" class="td-none text-dark">
                                    <?= trimText($chat['chat_title'], 15); ?>
                                </a>
                                <a href="#!" class="td-none text-dark remove-chat" href="javascript:void(0)" onclick="deleteRecord('ai_chats', 'chat_id', '<?=$chat['chat_id'];?>', '', 'account/ai-helpbot')">
                                    <i class="ri-close-large-fill"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- Add more dynamically via JavaScript -->
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content: Chat Interface -->
    <div class="col-md-8 col-lg-9">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    AI Helpbot
                </h5>
                <a href="<?=base_url('/account/ai-helpbot')?>" class="btn btn-outline-dark mx-1">
                    <i class="ri-add-fill"></i> New Chat
                </a>
            </div>
            <div class="card-body">
                <?php echo form_open(base_url('account/ai-helpbot/send-message'), 'method="post" class="g-3 needs-validation" enctype="multipart/form-data" novalidate'); ?>
                    <!-- Chat Display Area -->
                    <div class="overflow-auto border rounded p-3 mb-3" style="height: 400px;" id="chat-display">

                        <!-- Chat Messages -->
                        <div class="d-flex flex-column mb-2">
                            <div class="alert bg-dark text-center text-white w-100">
                                <i class="ri-robot-2-fill"></i> Hello! How can I assist you today?
                            </div>
                        </div>

                        <!--Chat responses-->
                        <?php if($chat_response): ?>
                            <?= formatAIResponse($chat_response); ?>
                        <?php endif; ?>
                    </div>

                    <!-- Chat Input Form -->
                    <input type="hidden" class="form-control me-2" id="chat_id" name="chat_id" value="<?=$chat_id?>">
                    <div id="chat-form" class="d-flex">
                        <textarea type="text" class="form-control me-2" id="message" name="message" placeholder="Type your question..." required maxlength="500"></textarea>
                        <button type="submit" class="btn btn-dark">
                            <i class="ri-send-plane-2-line"></i>
                        </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Include the delete script -->
<?= $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
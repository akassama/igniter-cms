<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AiChats extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'chat_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'chat_by' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'chat_title' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => false,
            ],
            'chat' => [
                'type' => 'TEXT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('chat_id', true);
        $this->forge->createTable('ai_chats');

        //insert default records
        //----------------------
        $data = [
            [
                'chat_id' => getGUID(),
                'chat_by'    => getGUID(getDefaultAdminGUID()),
                'chat_title'    => 'Explain how AI works',
                'chat'    => '<div class="d-flex flex-column mb-2"> <div class="d-flex flex-column mb-2 align-items-end"> <div class="alert alert-secondary w-75 text-end"> Explain how AI works? </div> </div> <div class="alert alert-light border w-75"> <div class="row text-end"> <a class="td-none copy-btn text-dark" data-clipboard-target="#ai-response-'.getGUID("5a090142-cf81-422c-a2b2-d61ec4713480").'"> <i class="ri-file-copy-line"></i> </a> </div> <div id="ai-response-'.getGUID("5a090142-cf81-422c-a2b2-d61ec4713480").'"> <p>Gemini AI, developed by Google, is a large multimodal AI model. This means it can work with and understand different types of information, including text, code, audio, and images. Unlike many models that specialize in one area, Gemini\'s strength lies in its ability to integrate these modalities. Here\'s a breakdown of how it works:<br /><br /><strong>1. Massive Dataset Training:</strong>&nbsp;Gemini is trained on a colossal dataset encompassing a wide variety of information formats. This dataset likely includes text from books and websites, code from various programming languages, audio recordings of speech and music, and images from across the internet. The sheer scale of the data allows Gemini to learn complex relationships and patterns across these different modalities.<br /><br /><strong>2. Transformer Architecture:</strong>&nbsp;Like many advanced language models, Gemini\'s core is based on the transformer architecture. Transformers excel at processing sequential data (like text or code) by paying attention to the relationships between different parts of the sequence. This allows Gemini to understand context, nuance, and long-range dependencies within the data it processes. However, Gemini\'s transformer likely has modifications and enhancements to handle the multimodal nature of its inputs.<br /><br /><strong>3. Multimodal Processing:</strong>&nbsp;This is where Gemini differentiates itself. Its architecture enables it to process and connect information from various sources simultaneously. For example, it might analyze an image, understand the text describing it, and then answer questions about both the image and the text, demonstrating a combined understanding. This integrated processing allows for more complex and nuanced tasks than unimodal models.<br /><br /><strong>4. Parameterized Models:</strong>&nbsp;The model uses a vast number of parameters (weights and biases that determine its behavior). These parameters are learned during training, allowing the model to adjust its responses based on the input data. The specific architecture and the number of parameters contribute significantly to Gemini\'s capabilities.</p> </div> </div> </div>'
            ],
            [
                'chat_id' => getGUID(),
                'chat_by'    => getGUID(getDefaultAdminGUID()),
                'chat_title'    => 'What is Igniter CMS',
                'chat'    => '<div class="d-flex flex-column mb-2"> <div class="d-flex flex-column mb-2 align-items-end"> <div class="alert alert-secondary w-75 text-end"> What is Igniter CMS? </div> </div> <div class="alert alert-light border w-75"> <div class="row text-end"> <a class="td-none copy-btn text-dark" data-clipboard-target="#ai-response-'.getGUID("4542f6c8-42e8-4ee1-9373-a5c08e3848f3").'"> <i class="ri-file-copy-line"></i> </a> </div> <div id="ai-response-'.getGUID("4542f6c8-42e8-4ee1-9373-a5c08e3848f3").'"> <p>Igniter CMS is a light but powerful, versatile Content Management System built on the robust CodeIgniter 4 framework. It offers a comprehensive solution for website management, content creation, and digital presence optimization.</p> </div> </div> </div>'
            ],
            [
                'chat_id' => getGUID(),
                'chat_by'    => getGUID(getDefaultAdminGUID()),
                'chat_title'    => 'What is a CMS',
                'chat'    => '<div class="d-flex flex-column mb-2"> <div class="d-flex flex-column mb-2 align-items-end"> <div class="alert alert-secondary w-75 text-end"> Hi, What is a CMS? </div> </div> <div class="alert alert-light border w-75"> <div class="row text-end"> <a class="td-none copy-btn text-dark" data-clipboard-target="#ai-response-'.getGUID("975ec114-2af2-436a-82a7-3c586a486f53").'"> <i class="ri-file-copy-line"></i> </a> </div> <div id="ai-response-'.getGUID("975ec114-2af2-436a-82a7-3c586a486f53").'"> <p>CMS stands for&nbsp;<strong>Content Management System</strong>. It\'s a software application that allows users to create, edit, and manage digital content on a website or app without needing extensive programming knowledge. Think of it as a user-friendly interface that sits on top of the website\'s underlying code, allowing non-technical users to easily update things like text, images, and videos.<br /><br />Here\'s a breakdown of what a CMS does:<br /><br /><em><strong>Content creation and editing:</strong>&nbsp;Users can add, modify, and delete content through a web-based interface, often using a WYSIWYG (What You See Is What You Get) editor.<br /></em><strong>Content organization:</strong>&nbsp;CMSs provide tools to structure and categorize content, typically using features like menus, categories, and tags.<br /><em><strong>Content publishing:</strong>&nbsp;The CMS handles the technical aspects of publishing content to the website, making it live and accessible to visitors.<br /></em><strong>User management:</strong>&nbsp;Many CMSs offer user roles and permissions, allowing different users to have varying levels of access to the system.<br /><em><strong>Search engine optimization (SEO):</strong>&nbsp;Many CMSs include features to help improve a website\'s search engine rankings, such as meta descriptions and URL management.<br /></em><strong>Template management:</strong>&nbsp;Users can often choose from different website templates or themes to customize the look and feel of their site.<br /><em><strong>Plugin/Extension support:</strong>&nbsp;CMSs often allow for extending their functionality through plugins or extensions, adding features like e-commerce, contact forms, or social media integration.<br /><br /><strong>Examples of popular CMSs:</strong><br /><br /></em><strong>WordPress:</strong>&nbsp;The most widely used CMS, particularly for blogs and smaller websites.<br /><em><strong>Joomla:</strong>&nbsp;A powerful and versatile CMS suitable for a wide range of websites.<br /></em><strong>Drupal:</strong>&nbsp;A highly flexible and robust CMS often used for large-scale websites and complex applications.<br /><em><strong>Squarespace:</strong>&nbsp;A user-friendly, all-in-one platform ideal for those who want a streamlined experience.<br /></em><strong>Wix:</strong>&nbsp;Another user-friendly platform with drag-and-drop functionality, suitable for beginners.<br /><br /><br />In essence, a CMS empowers individuals and organizations to manage their online presence without needing to be web developers. They simplify the process of creating and maintaining websites, making them accessible to a broader audience.</p> </div> </div> </div>'
            ],
        ];

        // Using Query Builder
        $this->db->table('ai_chats')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('ai_chats');
    }
}

<?php
if (!defined('ABSPATH')) exit;

function sm_register_post_type() {
    register_post_type('sinh_vien', [
        'labels' => [
            'name' => 'Sinh viên',
            'singular_name' => 'Sinh viên',
            'add_new_item' => 'Thêm sinh viên',
            'all_items' => 'Danh sách sinh viên'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'editor'],
    ]);
}
add_action('init', 'sm_register_post_type');
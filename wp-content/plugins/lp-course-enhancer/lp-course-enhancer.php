<?php
/**
 * Plugin Name: LP Custom Student Plugin
 * Description: Hiển thị thông báo + shortcode thông tin khóa học + custom style
 * Version: 1.0
 * Author: Student
 */

if (!defined('ABSPATH')) {
    exit;
}

//////////////////////////////
// 1. NOTIFICATION BAR
//////////////////////////////

add_action('wp_body_open', 'lp_student_notification_bar');

function lp_student_notification_bar() {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $name = $current_user->display_name;
        $message = "Chào $name, bạn đã sẵn sàng bắt đầu bài học hôm nay chưa?";
    } else {
        $message = "Đăng nhập để lưu tiến độ học tập!";
    }

    echo '<div class="lp-notification-bar">' . esc_html($message) . '</div>';
}

//////////////////////////////
// 2. SHORTCODE COURSE INFO
//////////////////////////////

add_shortcode('lp_course_info', 'lp_course_info_shortcode');

function lp_course_info_shortcode($atts) {
    // Kiểm tra LearnPress tồn tại
    if (!function_exists('learn_press_get_course')) {
        return "<p style='color:red;'>⚠️ LearnPress chưa được cài!</p>";
    }

    $atts = shortcode_atts([
        'id' => ''
    ], $atts);

    $course_id = intval($atts['id']);

    if (!$course_id) {
        return "⚠️ Thiếu ID khóa học";
    }

    $course = learn_press_get_course($course_id);

    if (!$course) {
        return "❌ Không tìm thấy khóa học";
    }

    // Số bài học
    $lessons = $course->get_items('lp_lesson');
    $lesson_count = is_array($lessons) ? count($lessons) : 0;

    // Thời gian
    $duration = get_post_meta($course_id, '_lp_duration', true);
    if (!$duration) {
        $duration = "Chưa cập nhật";
    }

    // Trạng thái
    $status_text = "Chưa đăng nhập";

    if (is_user_logged_in()) {
        $user = learn_press_get_current_user();
        $course_data = $user->get_course_data($course_id);

        if ($course_data) {
            $status = $course_data->get_status();

            switch ($status) {
                case 'enrolled':
                    $status_text = 'Đã đăng ký';
                    break;
                case 'finished':
                    $status_text = 'Đã hoàn thành';
                    break;
                default:
                    $status_text = ucfirst($status);
            }
        } else {
            $status_text = "Chưa đăng ký";
        }
    }

    return "
        <div class='lp-course-info'>
            <h3>📘 Thông tin khóa học</h3>
            <p>📚 <strong>Số bài học:</strong> $lesson_count</p>
            <p>⏱ <strong>Thời gian:</strong> $duration</p>
            <p>👤 <strong>Trạng thái:</strong> $status_text</p>
        </div>
    ";
}

//////////////////////////////
// 3. CUSTOM CSS
//////////////////////////////

add_action('wp_head', 'lp_custom_styles');

function lp_custom_styles() {
    echo "
    <style>
/* Notification Bar */
        .lp-notification-bar {
            background: #ff9800;
            color: white;
            text-align: center;
            padding: 10px;
            font-weight: bold;
            position: fixed;
            top: 32px;
            width: 100%;
            z-index: 9999;
        }

        body {
            margin-top: 50px;
        }

        /* Course Info Box */
        .lp-course-info {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            background: #f9f9f9;
            margin: 20px 0;
        }

        /* Nút Enroll */
        .lp-button, 
        .learn-press-course-buttons button {
            background-color: #4CAF50 !important;
            color: white !important;
            border-radius: 5px;
        }

        /* Hover */
        .lp-button:hover {
            background-color: #388E3C !important;
        }

        /* Finish Course */
        .course-item .lp-button-finish-course {
            background-color: #ff5722 !important;
        }
    </style>
    ";
}
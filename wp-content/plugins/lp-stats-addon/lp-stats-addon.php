<?php
/**
 * Plugin Name: LearnPress Stats Dashboard
 * Description: Hiển thị bảng thống kê tổng quan của LearnPress ngoài Dashboard và Frontend.
 * Version: 1.0
 * Author: NhatMinh
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}
function lp_get_total_stats() {
    global $wpdb;
    $total_courses = $wpdb->get_var("
        SELECT COUNT(ID) 
        FROM {$wpdb->posts} 
        WHERE post_type = 'lp_course' AND post_status = 'publish'
    ");
    $table_user_items = $wpdb->prefix . 'learnpress_user_items';
    if ( $wpdb->get_var("SHOW TABLES LIKE '$table_user_items'") != $table_user_items ) {
        return array('courses' => 0, 'students' => 0, 'completed' => 0);
    }
    $total_students = $wpdb->get_var("
        SELECT COUNT(DISTINCT user_id) 
        FROM {$table_user_items} 
        WHERE item_type = 'lp_course'
    ");
    $completed_courses = $wpdb->get_var("
        SELECT COUNT(user_item_id) 
        FROM {$table_user_items} 
        WHERE item_type = 'lp_course' AND status IN ('completed', 'finished', 'passed')
    ");

    return array(
        'courses'   => $total_courses ? $total_courses : 0,
        'students'  => $total_students ? $total_students : 0,
        'completed' => $completed_courses ? $completed_courses : 0
    );
}
function lp_stats_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'lp_stats_dashboard_widget',   
        'Thống kê LearnPress',             
        'lp_stats_dashboard_widget_display'
    );
}
add_action( 'wp_dashboard_setup', 'lp_stats_add_dashboard_widgets' );

function lp_stats_dashboard_widget_display() {
    $stats = lp_get_total_stats();
    echo '<ul style="font-size: 14px; line-height: 1.8; margin: 0; padding-left: 15px;">';
    echo '<li><strong>Tổng số khóa học:</strong> ' . esc_html($stats['courses']) . '</li>';
    echo '<li><strong>Tổng số học viên đã đăng ký:</strong> ' . esc_html($stats['students']) . '</li>';
    echo '<li><strong>Số khóa học đã hoàn thành:</strong> ' . esc_html($stats['completed']) . '</li>';
    echo '</ul>';
}
function lp_stats_shortcode_display() {
    $stats = lp_get_total_stats();
    ob_start();
    ?>
    <div class="lp-stats-container" style="border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; max-width: 350px; background-color: #f8fafc;">
        <h3 style="margin-top: 0; font-size: 18px;">Thống Kê Đào Tạo</h3>
        <ul style="list-style-type: none; padding: 0; margin: 0; line-height: 2;">
            <li>📚 <strong>Tổng số khóa học:</strong> <?php echo esc_html($stats['courses']); ?></li>
            <li>🎓 <strong>Tổng số học viên:</strong> <?php echo esc_html($stats['students']); ?></li>
            <li>✅ <strong>Hoàn thành:</strong> <?php echo esc_html($stats['completed']); ?></li>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'lp_total_stats', 'lp_stats_shortcode_display' );
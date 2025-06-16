<?php

// Стили
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('ndcoder-style', get_stylesheet_uri());
});

// Регистрация типа "Отзывы"
add_action('init', 'register_reviews_post_type');

function register_reviews_post_type() {
    register_post_type('review', [
        'labels' => [
            'name' => 'Отзывы',
            'singular_name' => 'Отзыв',
        ],
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => false,
        'supports' => ['title', 'editor'],
        'menu_icon' => 'dashicons-format-status',
        'exclude_from_search' => true,
        'publicly_queryable' => false,
    ]);
}

// Обработка формы
add_action('init', 'handle_feedback_form');

function handle_feedback_form() {
    if (isset($_POST['feedback_submit'])) {
        $errors = [];
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = wp_strip_all_tags($_POST['message']);

        if (empty($name)) {
            $errors['name'] = 'Введите имя.';
        }

        if (!is_email($email)) {
            $errors['email'] = 'Некорректный email.';
        }

        if ($message !== strip_tags($message) || empty($message)) {
            $errors['message'] = 'Отзыв не должен содержать HTML и не может быть пустым.';
        }

        if (empty($errors)) {
            wp_insert_post([
                'post_type'    => 'review',
                'post_title'   => $name,
                'post_content' => $message,
                'post_status'  => 'publish',
            ]);

            wp_redirect(add_query_arg('success', '1', get_permalink()));
            exit;
        } else {
            $GLOBALS['form_errors'] = $errors;
        }
    }
}

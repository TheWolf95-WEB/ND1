<h2>Последние отзывы:</h2>
<ul>
<?php
$reviews = new WP_Query([
    'post_type'      => 'review',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
]);

while ($reviews->have_posts()) : $reviews->the_post();
?>
    <li>
        <strong><?php the_title(); ?></strong><br>
        <small style="color:#ccc;"><?php echo get_the_date('d.m.Y H:i'); ?></small><br>
        <?php the_content(); ?>
    </li>
<?php endwhile; wp_reset_postdata(); ?>
</ul>

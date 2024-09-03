<?php get_header()?>

    <?php if(have_posts()) : while(have_posts()) :the_post(); ?>

        <section class="single bg-light_accent py-20 mb-[300px]">
        <div class="container px-4 mx-auto">
            <div class="single__content flex justify-between items-end">
            <h1 class="max-w-[550px] w-full mb-0">
                <?php the_title()?>
            </h1>
            <p class="font-bold">
                Published: <span class="font-normal"><?php echo get_the_date('n/j/Y')?></span>
            </p>
            </div>
            <div
            class="single__meta py-4 border-b border-t border-gray-100 mt-10 -mb-[220px]"
            >
            <ul class="flex justify-between">
                <li><span class="font-bold">Level:</span> <?php echo get_post_meta(get_the_ID(), 'Level', true)?></li>
                <li><span class="font-bold">Cooking Time:</span><?php echo get_post_meta(get_the_ID(), 'Time', true)?></li>
                <li><span class="font-bold">Servings:</span> <?php echo get_post_meta(get_the_ID(), 'Serving', true)?></li>
            </ul>
            </div>

            <div class="single__content grid grid-cols-[2fr_1fr] gap-10 translate-y-[260px]">
            <?php if(has_post_thumbnail()) {the_post_thumbnail(); }?>
            <div class="bg-accent text-white px-10 py-14">
                <h3>Ingredients</h3>
                <ul>
                    <?php $blocks = parse_blocks($post->post_content);
                        foreach ($blocks as $block) {
                        if ($block['blockName'] == 'core/list') {
                            echo render_block($block);
                        }
                    }?>
                </ul>
            </div>
            </div>
        </div>
        </section>

        <section>
        <div class="container mx-auto px-6">
            <h3 class="text-accent mb-10">Direction</h3>

            <div class="grid grid-cols-[2fr_1fr] gap-10">
            <main>
                <?php $blocks = parse_blocks($post->post_content);
                foreach ($blocks as $block) {
                if ($block['blockName'] != 'core/list') {
                    echo render_block($block);
                }
            }?>
            </main>
            <aside>
                <div class="page__sidebar">
                <h4 class="mb-10">Looking for something else</h4>
                    <?php $sidebar = new WP_Query(array ( 
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'orderby' => 'rand',
                        'post_not_in' => array(get_the_ID())
                    ))?>

                    <?php if($sidebar->have_posts()) : while($sidebar->have_posts()) :$sidebar->the_post(); ?>

                    <div class="recipe__card flex gap-5 mb-5">
                    <?php if(has_post_thumbnail()) {the_post_thumbnail(); }?>
                    <div>
                        <small><?php echo get_the_category()[0]->name?></small>
                        <h5><?php the_title()?></h5>
                        <ul class="flex gap-1">
                            <li><i class="fas fa-star <?php echo get_post_meta(get_the_ID(), 'Rating1', true)?>"></i></li>
                            <li><i class="fas fa-star <?php echo get_post_meta(get_the_ID(), 'Rating2', true)?>"></i></li>
                            <li><i class="fas fa-star <?php echo get_post_meta(get_the_ID(), 'Rating3', true)?>"></i></li>
                            <li><i class="fas fa-star <?php echo get_post_meta(get_the_ID(), 'Rating4', true)?>"></i></li>
                            <li><i class="fas fa-star <?php echo get_post_meta(get_the_ID(), 'Rating5', true)?>"></i></li>
                        </ul>
                        <a href="<?php the_permalink()?>">Get recipe</a>
                    </div>
                    </div>

                    <?php endwhile;
                        else:
                            echo "no menus";
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
            </aside>
            </div>
        </div>
        </section>

    <?php endwhile;
        else:
            echo "no menus";
        endif;
    ?>

<?php get_footer()?>
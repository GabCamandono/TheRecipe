<?php get_header()?>

    <?php if(have_posts()) : while(have_posts()) :the_post(); ?>
    <section class="page__banner bg-light_accent mb-[180px]">
      <div class="container px-4 mx-auto">
        <div class="text-center pt-10">
          <h1 class="-mb-7"><?php the_title()?></h1>
            <?php if(has_post_thumbnail()) {the_post_thumbnail(); }?>
        </div>
      </div>
    </section>

    <section class="page__content mb-20">
      <div class="container px-4 mx-auto">
        <div
          class="grid grid-cols-1 md:grid-cols-[1fr_350px] gap-10 max-w-[1000px] w-full mx-auto"
         >
          <div class="page__body max-w-[800px] w-full mx-auto">
            <h2><?php the_title()?></h2>
            <?php echo get_the_content()?>

            <ul>
              <li><?php echo get_post_meta(get_the_ID(), 'Source', true)?></li>
              <li><?php echo get_post_meta(get_the_ID(), 'Address', true)?></li>
              <li><?php echo get_post_meta(get_the_ID(), 'City', true)?></li>
            </ul>
          </div>



            <div class="page__sidebar">
                <h4 class="mb-10">Looking for something else</h4>

                <?php $sidebar = new WP_Query(array ( 
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'meta_key' => 'Groupings',
                    'meta_value' => 'Sidebar',
                    'order' => 'ASC'
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



        </div>
      </div>
    </section>

    <?php endwhile;
        else:
            echo "no menus";
        endif;
    ?>

<?php get_footer()?>
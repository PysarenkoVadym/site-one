<?php /* Template Name: Home */ ?>


<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = '[PHP Snippets] From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>


<?php get_header() ?>
<div class="container">
    <section class="promo__articl">
        <div>
            <?php
            $news = new WP_Query(array(
                'post_type' => 'news',
                'posts_per_page' => 1,

            ));
            if ($news->have_posts()) : while ($news->have_posts()) : $news->the_post(); ?>
                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
                        <div>
                            <?php the_terms(get_the_ID(), 'heading', '', ' / ', ''); ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                            <p><?php echo get_the_content(); ?></p>
                        </div>
                        <div> <?php the_post_thumbnail('promo_post_size'); ?></div>

        </div>
        </article>
    <?php endwhile  ?>

<?php endif;
            wp_reset_postdata();
?>

    </section>

    <section class="benefits__columns">
        <div class="column">

            <?php

            if (have_rows('benefits_columns')) :

                while (have_rows('benefits_columns')) : the_row();

                    $img = get_sub_field('benefits_img');
                    $picture = $img['sizes']['thumbnail'];
                    $bnf_title = get_sub_field('benefits_title');
                    $bnf_text = get_sub_field('benefits_text');
                    $link = get_sub_field('benefits_link');

            ?>
                    <?php if ($img) : ?>
                        <img class="benefits__img" src="<?php echo $picture; ?>" alt="<?php $img['alt']; ?>">
                    <?php endif ?>
                    <?php if ($bnf_title) : ?>
                        <h3 class="benefits__title"> <?php echo $bnf_title ?> </h3>
                    <?php endif ?>
                    <?php if ($bnf_text) : ?>
                        <p class="benefits__text"> <?php echo $bnf_text ?> </p>
                    <?php endif ?>
                    <?php if ($link) : ?>
                        <a class="benefits__url" href="<?php echo $link['url']; ?>">Read Articles</a>
                    <?php endif ?>
            <?php
                endwhile;

            else :

            endif; ?>

        </div>
    </section>

    <section class="articles">
        <div class="last__articles">
            <div class="articles__title">
                <?php
                $art_title = get_field('latest_articles_title');
                if ($art_title) : ?>
                    <h3><?php echo $art_title ?></h3>
                <?php endif ?>
            </div>
            <div class="last__posts">

                <?php
                $news = new WP_Query(array(
                    'post_type' => 'news',
                    'posts_per_page' => 4,

                ));
                if ($news->have_posts()) : while ($news->have_posts()) : $news->the_post();

                        $cmnt = array(
                            'post_id' => 1,
                            'count'   => true,
                        );
                        $comments_count = get_comments($cmnt);
                ?>
                        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
                            <div> <?php the_post_thumbnail('last_posts_size'); ?></div>
                            <div>
                                <?php the_terms(get_the_ID(), 'heading', '', ' / ', ''); ?>
                                <h3><?php echo get_the_title(); ?></h3>
                                <small>
                                    <p>added: <?php echo get_the_time('jS F, Y'); ?> <?php echo $comments_count; ?>
                                </small></p>
                                <p><?php echo get_the_content(); ?></p>
                                <div><img><?php echo get_avatar(get_the_ID(), 24, '', '', null); ?></img> <?php echo get_the_author_posts_link(); ?></div>
                            </div>
                        </article>
            </div>

        </div>
    <?php endwhile  ?>

<?php endif;
                wp_reset_postdata();
?>
    </section>


    <section class="promo__about__us">
        <div class="promo__us__img">
            <?php
            $image = get_field('promo_us_image');
            if ($image) :

                $size = 'promo_us_size';
                $thumb = $image['sizes'][$size];
                $width = $image['sizes'][$size . '-width'];
                $height = $image['sizes'][$size . '-height'];

                if ($caption) : ?>
                    <div class="wp-caption">
                    <?php endif; ?>

                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                <?php endif; ?>
                    </div>
                    <div class="promo__us__content">
                        <?php
                        $prm_up_title = get_field('promo_us_uper_title');
                        $prm_us_title = get_field('promo_us_title');
                        $prm_us_text = get_field('promo_us_text');
                        $prm_us_link = get_field('promo_us_link');

                        ?>

                        <?php if ($prm_up_title) : ?>
                            <p><?php echo $prm_up_title ?></p>
                        <?php endif ?>

                        <?php if ($prm_us_title) : ?>
                            <h3><?php echo $prm_us_title ?></h3>
                        <?php endif ?>

                        <?php if ($prm_us_text) : ?>
                            <p><?php echo $prm_us_text ?></p>
                        <?php endif ?>

                        <?php
                        if ($prm_us_link) : ?>
                            <a class="button" href="<?php echo esc_url($prm_us_link); ?>">Learn More</a>
                        <?php endif; ?>
                    </div>
        </div>
    </section>


    <section class="newsletter">
        <div class="newsletter__content">
            <div class="newsletter__addressed">
                <?php
                $nwltr_title = get_field('newsletter_title');
                $nwltr_text = get_field('newsletter_text');
                ?>
                <?php if ($nwltr_title) : ?>
                    <h3><?php echo $nwltr_title ?></h3>
                <?php endif ?>

                <?php if ($nwltr_text) : ?>
                    <p><?php echo $nwltr_text ?></p>
                <?php endif ?>
            </div>
            <div class="newsletter__mail">


            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="thanks">
								<p>Thanks, your email was sent successfully.</p>
							</div>
						<?php } else { ?>
							<?php the_content(); ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error">Sorry, an error occured.<p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							<ul class="contactform">
							<li>
								<label for="contactName">Name:</label>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if($nameError != '') { ?>
									<span class="error"><?=$nameError;?></span>
								<?php } ?>
							</li>

							<li>
								<label for="email">Email</label>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if($emailError != '') { ?>
									<span class="error"><?=$emailError;?></span>
								<?php } ?>
							</li>

							<li><label for="commentsText">Message:</label>
								<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if($commentError != '') { ?>
									<span class="error"><?=$commentError;?></span>
								<?php } ?>
							</li>

							<li>
								<input type="submit">Send email</input>
							</li>
						</ul>
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>
				<?php } ?>
				</div><!-- .entry-content -->
			</div><!-- .post -->

				<?php endwhile; endif; ?>


            </div>
    </section>

</div>
</div>

<!-- <?php get_footer() ?> -->
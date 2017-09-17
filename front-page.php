<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Personal Theme
 */

get_header(); ?>

	<div id="primary" class="content-area front-content">

		<div class="top home-section home-section__image backstretch" style="background-image: url('<?php echo get_stylesheet_directory_uri() . "/images/desk.jpg" ; ?>')">
			<div class="overlay"></div>
			<div class="content">
				<h2 class="title">Ren Ventura</h2>
				<div class="excerpt typeit">Software developer. Problem solver.</div>
			</div>
		</div>

		<div class="home-section home-section__content">
			<div class="content">
				<img src="<?php echo get_stylesheet_directory_uri() . '/images/renventura.jpg' ?>" alt="Ren Ventura" class="headshot aligncenter">
				<h2 class="title">Hey, I'm Ren</h2>
				<div class="excerpt">I develop software solutions for complexities facing modern businesses. I live for what I do. When I'm not "working", I'm either learning new skills, or cooking (and eating, of course).</div>
			</div>
		</div>
			
		<div class="home-section home-section__image backstretch" style="background-image: url('<?php echo get_stylesheet_directory_uri() . "/images/code-editor.jpg" ; ?>')">
			<div class="overlay"></div>
		</div>

		<div class="home-section home-section__content">
			<h2 class="title">What I Know</h2>
			<div class="excerpt">
				<p>HTML5 &amp; CSS3</p>
				<p>JavaScript</p>
				<p>PHP, Java</p>
				<p>WordPress &amp; WooCommerce</p>
			</div>
		</div>

		<div class="home-section home-section__image backstretch" style="background-image: url('<?php echo get_stylesheet_directory_uri() . "/images/html-code.jpg" ; ?>')">
			<div class="overlay"></div>
		</div>

		<div id="work" class="home-section home-section__content">
			<h2 class="title">Recent Work</h2>
			<div class="excerpt">
				<p>See my <a href="https://github.com/renventura" target="_blank" rel="noopener noreferrer">Github</a> profile for code samples</p>
			</div>
			<?php
				$projects = new WP_Query( array(
					'post_type' => 'portfolio',
					'posts_per_page' => 3,
				) );

				if ( $projects->have_posts() ) : ?>

					<div class="projects">

						<div class="row">
						
							<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>

								<?php
									$thumb = get_field( 'archive_thumbnail' );
									$terms = array();
									foreach ( get_the_terms( get_the_id(), 'portfolio_cat' ) as $term ) {
										$terms[] = $term->name;
									}
									$terms = implode( ', ', $terms );
								?>

								<div class="col-xs">
									<div class="box project" itemscope itemtype="http://schema.org/CreativeWork">
										<a href="<?php the_permalink(); ?>" itemprop="url"><img itemprop="thumbnailUrl" src="<?php echo $thumb['url']; ?>" alt="<?php echo $thumb['alt']; ?>"></a>
										<a href="<?php the_permalink(); ?>" itemprop="url"><h3 itemprop="title" class="archive-title"><?php the_title(); ?></h3></a>
										<div class="archive-terms"><?php echo $terms; ?></div>
									</div>
								</div>

							<?php endwhile; ?>

						</div>

					</div>

				<?php endif;

				wp_reset_postdata();
			?>
		</div>
		
		<div class="home-section home-section__map">
			<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6120069.22736771!2d-86.18829027705978!3d41.49744701508516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8830ef2ee3686b2d%3A0xed04cb55f7621842!2sCleveland%2C+OH!5e0!3m2!1sen!2sus!4v1504892025277" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>

		<div id="contact" class="home-section home-section__content">
			<h2 class="title">Get in touch</h2>
			<a href="https://twitter.com/CLE_Ren" target="_blank" rel="noopener noreferrer"><?php include get_stylesheet_directory() . '/images/twitter.svg'; ?></a>
			<a href="https://github.com/renventura" target="_blank" rel="noopener noreferrer"><?php include get_stylesheet_directory() . '/images/github.svg'; ?></a>
			<a href="https://www.linkedin.com/in/renventura/" target="_blank" rel="noopener noreferrer"><?php include get_stylesheet_directory() . '/images/linkedin.svg'; ?></a>
			<div class="excerpt contact-form">
				<?php echo do_shortcode( '[ninja_form id=1]' ); ?>
			</div>
		</div>

		<div class="home-section home-section__image backstretch" style="background-image: url('<?php echo get_stylesheet_directory_uri() . "/images/flat-guy-at-desk.jpg" ; ?>')">
			<div class="overlay"></div>
		</div>

		<div class="home-section home-section__content">
			<div class="left">
				<h2 class="title">About Me</h2>
				<p>Started developing software in 2012</p>
				<p>Graduated Cleveland State University in 2015</p>
				<p>Code is my passion, hobby, and relaxer</p>
			</div>
			<div class="right">
				<h2 class="title">Random Facts</h2>
				<p>I love suits (and ties), a lot!</p>
				<p>Country music all day long</p>
				<p>Donuts are my favorite thing in life</p>
			</div>
		</div>
			
	</div>

	<script>
		jQuery(document).ready(function($) {
			$('.typeit').typeIt({
					// strings: ["This is a great string.", "And here we have another great string.."],
					speed: 50,
					autoStart: false
				})
			});
	</script>

<?php
get_footer();

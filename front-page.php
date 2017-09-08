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

		<div class="top home-section home-section__image backstretch" style="background-image: url('http://localhost:8888/wpapi/wp-content/uploads/2016/10/desk-items.jpg')">
			<div class="overlay"></div>
			<div class="content">
				<h2 class="title">Ren Ventura</h2>
				<div class="excerpt typeit">Software developer. Cleveland, Ohio.</div>
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
				<p>Version control (Git)</p>
				<p>WordPress &amp; WooCommerce</p>
			</div>
		</div>

		<div class="home-section home-section__image backstretch" style="background-image: url('<?php echo get_stylesheet_directory_uri() . "/images/html-code.jpg" ; ?>')">
			<div class="overlay"></div>
		</div>

		<div class="home-section home-section__content">
			<h2 class="title">Work Samples</h2>
			<div class="excerpt">
				See my <a href="https://github.com/renventura" target="_blank" rel="noopener noreferrer">Github</a> profile for code samples
			</div>
		</div>
		
		<div class="home-section home-section__map">
			<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6120069.22736771!2d-86.18829027705978!3d41.49744701508516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8830ef2ee3686b2d%3A0xed04cb55f7621842!2sCleveland%2C+OH!5e0!3m2!1sen!2sus!4v1504892025277" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>

		<div class="home-section home-section__content">
			<h2 class="title">Get in touch</h2>
			<a href="https://www.linkedin.com/in/renventura/" target="_blank" rel="noopener noreferrer"><?php include get_stylesheet_directory() . '/images/linkedin.svg'; ?></a>
			<a href="https://twitter.com/CLE_Ren" target="_blank" rel="noopener noreferrer"><?php include get_stylesheet_directory() . '/images/twitter.svg'; ?></a>
			<div class="excerpt contact-form">
				<?php echo do_shortcode( '[ninja_form id=2]' ); ?>
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

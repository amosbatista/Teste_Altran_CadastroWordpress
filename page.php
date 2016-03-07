
<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<?php
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nome = $_POST["txtNome"];
		$endereco = $_POST["txtEndereco"];
		$numero = $_POST["txtNumero"];
		
		//Valida��o
		if ($nome == ""){
			$alerta .= "O campo Nome n�o foi informado.";
		}
		else if ($endereco ==""){
			$alerta .= "O campo Endere�o n�o foi informado.";
		}
		else if ($numero == ""){
			$alerta .= "O campo N�mero n�o foi informado.";
		}
		else if (!filter_var($numero, FILTER_VALIDATE_INT)){
			$alerta .= "O campo N�mero precisa receber um valor num�rico v�lido.";
		}
		
		if($alerta == ""){
		
			$parametrosMetadados = array("Nome" => $nome, "Endereco" => $endereco, "Numero" => $numero );
			$parametrosPost = array("post_title" => $nome, "post_content" => $nome, "post_status" => "publish", "meta_input" => $parametrosMetadados);
		
			$resultado = wp_insert_post($parametrosPost);
		
			if($resultado > 0){
				$alerta = "A pessoa foi cadastrada.";
				echo "<script type='text/javascript'>alert('$alerta');</script>";
				echo "<script type='text/javascript'>window.location.href = 'https://localhost/blog/';</script>";
			}
			else{
				$alerta = "A pessoa n�o p�de ser cadastrada. Favor tentar novamente.";
			}
		}
		
		echo "<script type='text/javascript'>alert('$alerta');</script>";
	}
?>



<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

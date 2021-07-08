<?php
/***
 * My Github
 *
 * @since 1.0.0
 *
 * @package MyGitHub
 */
?>
<div class="wrap">
    <div class="card aligncenter">
        <?php
        if ( empty( $body ) ) {
            echo '<h3>Nothing found</h3>';

            return false;
        }
		?>
            <div class="container-no-hover">
                <button onclick="window.history.back();">All jobs</button>
                <div class="alignright">
                    <strong><?php echo esc_html( $body->type ); ?></strong>
                    / <a href="<?php echo esc_attr( $body->company_url ); ?>"><?php echo esc_attr( $body->company ); ?></a>
                </div>
                <h1><?php echo esc_html( $body->title ); ?></h1>
                <hr/>
                <?php
                if ( ! empty( $body->company_logo ) ) {
                    ?>
                    <img src="<?php echo esc_attr( $body->company_logo ); ?>" alt="<?php echo esc_attr( $body->company ); ?>" />
                    <?php
                }
                ?>
                <?php echo $body->how_to_apply; ?>
                <?php echo $body->description; ?>
            </div>
    </div>
</div>

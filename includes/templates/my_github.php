<?php
/***
 * My Github
 *
 * @since 1.0.0
 *
 * @author Abdullah Al Mahi<hello@abdullahmahi.com>
 *
 * @package MyGitHub
 */
?>
<div class="wrap">
    <div class="clearfix">
        <form accept-charset="UTF-8" method="get">
            <div>
                <label for="description_field"><b>Job Description</b></label>
                <input value="<?php echo isset( $_GET['description'] ) ? $_GET['description'] : null; ?>" type="text" name="description" id="description_field" placeholder="Filter by title, benefits, companies, expertise" autocomplete="off">
                <label for="location_field"><b>Location</b></label>
                <input value="<?php echo isset( $_GET['location'] ) ? $_GET['location'] : ''; ?>" type="text" name="location" id="location_field" placeholder="Filter by city, state, zip code or country" autocomplete="off">
                <label for="full_time_field">
                    <input<?php echo isset( $_GET['full_time'] ) ? 'checked' : ''; ?> type="checkbox" name="full_time" id="full_time_field" value="on">
                    Full Time Only
                </label>
                <button type="submit">Search</button>
            </div>
        </form>
    </div>
    <div class="card aligncenter">
        <?php
        if ( empty( $body ) ) {
            echo '<h3 class="container-no-hover">Nothing found</h3>';
            return false;
        }
        if ( isset( $_GET['location'] ) || isset( $_GET['description'] ) ) {
            echo '<a class="alignright" href="' . get_permalink() . '">All jobs</a>';
            echo '<h4 class="container-no-hover">Showing ' . count( $body ) . ' jobs</h4>';
        }

        foreach ( $body as $key => $job ) {
            ?>
            <div class="container">
                <div class="alignright">
                    <?php echo esc_html( $job->location ); ?>
                    <div class="small">
                        about <?php echo esc_html( human_time_diff( strtotime( $job->created_at ) ) ); ?> ago
                    </div>
                </div>
                <a href="<?php echo esc_attr( get_permalink() . '?job_id=' . $job->id . '&job_key=' . $key ); ?>">
                    <strong><?php echo esc_html( $job->title ); ?></strong>
                </a>
                <div>
                    <a href="<?php echo esc_attr( $job->company_url ); ?>"><?php echo esc_attr( $job->company ); ?></a>
                    <?php
					if ( ! empty( $job->company_logo ) ) {
						?>
                    <img src="<?php echo esc_attr( $job->company_logo ); ?>" alt="<?php echo esc_attr( $job->company ); ?>" class="company-logo">
						<?php
					}
                    ?>
                    - <strong class="color-green"><?php echo esc_html( $job->type ); ?></strong>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

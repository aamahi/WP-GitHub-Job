<?php

namespace My\GitHub;

/**
 * The Installer Class
 *
 * @package My\GitHub
 */
class Installer {
    /**
     * run the installer
     *
     * @return void
     */
    public function run() {
        $this->add_version();
        $this->insert_page();
    }

    /**
     * Add Time and Version On DB
     */
    public function add_version() {
        if ( ! get_option( '_my_github_installed' ) ) {
            update_option( '_my_github_installed', time() );
        }
        update_option( '_my_github_version', MY_GITHUB_VERSION );
    }

    /**
     * Create Github Job Page Page;
     *
     * @return void
     */
    public function insert_page() {

        $current_user = wp_get_current_user();
        $page = [
            'post_title'   => __( "GitHub Job List", 'wp-member-manager' ),
            'post_content' => "[my_github]",
            'post_status'  => 'publish',
            'post_author'  => $current_user->ID,
            'post_type'    => 'page',
        ];
            // insert the post into the database
        wp_insert_post( $page );
    }
}

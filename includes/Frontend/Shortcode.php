<?php
/***
 * Menu class file
 *
 * @since 1.0.0
 *
 * @author Abdullah Al Mahi <hello@abdullahmahi.com>
 *
 * @package MyGitHub
 */

namespace My\GitHub\Frontend;

use My\GitHub\Transient;

/**
 * Class Frontend
 *
 * @package Featured\Posts\Frontend
 */
class Shortcode {

    /**
     * For storing AdminTransient instance
     *
     * @var Transient $admin_transient
     */
    public Transient $admin_transient;

    /**
     * Frontend constructor.
     */
    public function __construct() {
        $this->admin_transient = new Transient();
        add_shortcode( 'my_github', array( $this, 'cb_my_github_shortcode' ) );
        add_filter( 'http_request_timeout', array( $this, 'extend_http_request_timeout' ) );
    }

    /**
     * To extend http request timeout
     *
     * @param  int  $time  default time.
     *
     * @return int
     */
    public function extend_http_request_timeout( int $time ) {
        $time = 30;

        return $time;
    }

    /**
     * Callback for My GitHub shortcode
     *
     * @return void
     */
    public function cb_my_github_shortcode() {
        $body = Transient::my_github_all_jobs( 'https://jobs.github.com/positions.json' );

        if ( isset( $_GET[ 'job_id' ] ) && isset( $_GET[ 'job_key' ] ) ) {
            $job_key = $_GET[ 'job_key' ];
            $body    = $body[ $job_key ];

            include_once MY_GITHUB_INCLUDE_PATH . '/templates/single_job.php';
        } else {
            include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github.php';
        }
    }

}

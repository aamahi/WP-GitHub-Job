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

namespace My\GitHub;

/**
 * Class Transient
 *
 * @package My\GitHub
 */
class Transient {

    /**
     * Get github all jobs
     *
     * @param  string $url Github jobs url.
     *
     * @return false|mixed|void
     */
    public static function my_github_all_jobs( string $url ) {
        $query_string = null;

        if ( isset( $_GET['description'] ) || isset( $_GET['location'] ) ) {
            if ( isset( $_GET['full_time'] ) ) {
                $query_string = "?description={$_GET[ 'description' ]}&location={$_GET[ 'location' ]}&full_time={$_GET[ 'full_time' ]}";
            } else {
                $query_string = "?description={$_GET[ 'description' ]}&location={$_GET[ 'location' ]}";
            }
        }

        $cache_key = md5( $query_string );
        $body      = get_transient( "my_github_all_jobs_{$cache_key}" );

        if ( ! $body ) {
            $url           = $url . $query_string;
            $response      = wp_remote_get( "{$url}" );
            $body          = wp_remote_retrieve_body( $response );
            $body          = json_decode( $body );
            $response_code = wp_remote_retrieve_response_code( $response );

            if ( 200 === $response_code ) {
                set_transient( "my_github_all_jobs_{$cache_key}", $body, ( HOUR_IN_SECONDS / 2 ) );
            } else {
                $body = '';
            }
        }

        return $body;
    }
}

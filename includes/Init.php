<?php
/***
 * Initial class file
 *
 * @since 1.0.0
 *
 * @author Abdullah Al Mahi <hello@abdullahmahi.com>
 *
 * @package MyGitHub
 */

namespace My\GitHub;

use My\GitHub\Frontend\Shortcode;

/**
 * Class Init
 *
 * @package My\GitHub
 */
class Init {

    /**
     * Getaway for all classes.
     *
     * @return void
     */
    public static function register() {
        if ( ! is_admin() ) {
            new Assets();
            new Shortcode();
        }
    }
}

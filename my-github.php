<?php
/**
 * Plugin Name:         My Github Jobs
 * Plugin URI:          https://github.com/aamahi/WP-GitHub-Job.
 * Description:         A simple WordPress plugin that can track github's job.
 * Version:             1.5.0
 * Requires at least:   5.2
 * Author:              Abdullah Al Mahi
 * Author URI:          https://abdullahmahi.com/
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         my-github
 * Domain Path:         /languages
 */


// To prevent direct access, if not define WordPress ABSOLUTE PATH then exit.
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Class MyGithub
 */
class MyGithub {

    // Plugin version.
    public const MY_GITHUB_VERSION = '1.0.0';

    /**
     * FeaturedPosts constructor.
     */
    public function __construct() {
        $this->localization_setup();
        $this->define_constant();

        add_action( 'activate_plugin', [ $this, 'cb_activate_plugin' ] );
        add_action( 'plugins_loaded', [ $this, 'initiate_plugin' ] );
    }

    /**
     * Define main plugin constant here for future use.
     *
     * @return void
     */
    public function define_constant() {
        define( 'MY_GITHUB_VERSION', self::MY_GITHUB_VERSION );
        define( 'MY_GITHUB_BASE_NAME', plugin_basename( __FILE__ ) );
        define( 'MY_GITHUB_BASE_PATH', __DIR__ );
        define( 'MY_GITHUB_INCLUDE_PATH', __DIR__ . '/includes' );
        define( 'MY_GITHUB_URL', plugins_url( '', __FILE__ ) );
        define( 'MY_GITHUB_ASSETS', MY_GITHUB_URL . '/assets' );
    }

    /**
     * Activating the plugin
     *
     * @return void
     */
    public function cb_activate_plugin() {
        $installer = new \My\GitHub\Installer();
        $installer->run();
    }

    /**
     * Initialize plugin for localization
     *
     * @return void
     */
    public function localization_setup() {
        load_plugin_textdomain( 'my-github', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    /**
     * Initiate the plugin
     *
     * @return void
     */
    public function initiate_plugin() {
        \My\GitHub\Init::register();
    }

    /**
     * Init method for MyGithub
     *
     * @return false|\MyGithub
     */
    public static function init() {
        $instance = false;
        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }
}

/**
 * Initialize the Github
 *
 * @return void
 */
function github_jobs() {
    MyGithub::init();
}

/**
 * Hit start
 */
github_jobs();

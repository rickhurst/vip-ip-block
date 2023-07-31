<?php
/**
 * Plugin Name: VIP IP Blocker
 * Description: Provides WP CLI commands to block, unblock, and list IP addresses using VIP_Request_Block.
 * Author: Rick Hurst
 */

// Register the WP CLI commands
if ( defined( 'WP_CLI' ) && WP_CLI ) {
    require_once( plugin_dir_path( __FILE__ ) . 'class-vip-ip-blocker-command.php' );
    WP_CLI::add_command( 'vipipblock', 'VIP_IP_Blocker_Command' );
} else {

    function vip_ip_block_early() {
        if ( class_exists( 'VIP_Request_Block' ) ) {
            $blocked_ips = get_option( 'vipipblock', array() );
            foreach ( $blocked_ips as $ip_address ) {
                VIP_Request_Block::ip( $ip_address );
            }
        }
    }
    add_action( 'init', 'vip_ip_block_early' );
}


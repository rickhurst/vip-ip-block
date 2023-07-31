<?php

class VIP_IP_Blocker_Command extends WP_CLI_Command {

    /**
     * Add an IP address to the VIP IP Block list.
     *
     * ## OPTIONS
     *
     * <ipaddress>
     * : The IP address to block.
     *
     * ## EXAMPLES
     *
     * wp vipipblock add 13.37.13.37
     *
     * @param array $args The list of arguments passed to the command.
     * @param array $assoc_args The list of associative arguments passed to the command.
     */
    public function add( $args, $assoc_args ) {
        $ip_address = $args[0];
        $blocked_ips = get_option( 'vipipblock', [] );

        if ( count( $blocked_ips ) >= 50 ) {
            WP_CLI::error( 'The maximum number of blocked IP addresses (50) has been reached for this plugin. To block additional IP addresses, add the `VIP_Request_Block::ip()` commands in the codebase.' );
        }

        if ( ! in_array( $ip_address, $blocked_ips, true ) ) {
            $blocked_ips[] = $ip_address;
            update_option( 'vipipblock', $blocked_ips );
            WP_CLI::success( 'IP address added to the block list.' );
        } else {
            WP_CLI::warning( 'IP address is already in the block list.' );
        }
    }

    /**
     * Remove an IP address from the VIP IP Block list.
     *
     * ## OPTIONS
     *
     * <ipaddress>
     * : The IP address to unblock.
     *
     * ## EXAMPLES
     *
     * wp vipipblock remove 13.37.13.37
     *
     * @param array $args The list of arguments passed to the command.
     * @param array $assoc_args The list of associative arguments passed to the command.
     */
    public function remove( $args, $assoc_args ) {
        $ip_address = $args[0];
        $blocked_ips = get_option( 'vipipblock', [] );

        if ( ( $key = array_search( $ip_address, $blocked_ips, true ) ) !== false ) {
            unset( $blocked_ips[$key] );
            update_option( 'vipipblock', $blocked_ips );
            WP_CLI::success( 'IP address removed from the block list.' );
        } else {
            WP_CLI::warning( 'IP address is not in the block list.' );
        }
    }

    /**
     * List all IP addresses in the VIP IP Block list.
     *
     * ## EXAMPLES
     *
     * wp vipipblock list
     *
     * @param array $args The list of arguments passed to the command.
     * @param array $assoc_args The list of associative arguments passed to the command.
     */
    public function list( $args, $assoc_args ) {
        $blocked_ips = get_option( 'vipipblock', array() );

        if ( ! empty( $blocked_ips ) ) {
            WP_CLI::line( 'Blocked IP addresses:' );
            WP_CLI::line( implode( PHP_EOL, $blocked_ips ) );
        } else {
            WP_CLI::success( 'No IP addresses are currently blocked.' );
        }
    }
}

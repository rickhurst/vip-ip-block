# VIP IP Blocker

VIP IP Blocker is a WordPress plugin that provides WP CLI commands to easily manage a list of blocked IP addresses on [VIP Platform](https://wpvip.com/). It allows you to block, unblock, and list IP addresses that should be restricted from accessing your WordPress VIP site using the `VIP_Request_Block::ip()` method at the application level, [as documented in the WP VIP Docs](https://docs.wpvip.com/how-tos/block-requests/#h-block-by-ip).

Note that the intention of this plugin is to allow IP addresses to be blocked "on-the-fly" without the need to write, test, commit and deploy - but adding to the codebase is more efficient. As such the number of IP addresses that can be added via this plugin is limited to 50, as they are stored in a wp option and this data needs to be kept relatively small for efficiency.

## Installation

Copy the plugin to your wpvip repo plugin directory and commit/ merge to deploy to the relevant environment, then activate. 

## WP CLI Commands

The VIP IP Blocker plugin introduces the following WP CLI commands:

### Block an IP Address

```
wp vipipblock add <ipaddress>
```

Use this command to add an IP address to the VIP IP Block list. Replace `<ipaddress>` with the IP address you want to block. If the IP address is already in the block list, you will receive a warning.

**Example:**

```
wp vipipblock add 13.37.13.37
```

### Unblock an IP Address

```
wp vipipblock remove <ipaddress>
```

Use this command to remove an IP address from the VIP IP Block list. Replace `<ipaddress>` with the IP address you want to unblock. If the IP address is not in the block list, you will receive a warning.

**Example:**

```
wp vipipblock remove 13.37.13.37
```

### List Blocked IP Addresses

```
wp vipipblock list
```

Use this command to list all the IP addresses currently in the VIP IP Block list.

**Example:**

```
wp vipipblock list
```

## IP Blocking Functionality

The plugin automatically blocks the IP addresses stored in the `vipipblock` option as soon as WordPress plugins have loaded. The code for IP blocking uses the `VIP_Request_Block` class. Any IP addresses added to the block list will be restricted from accessing your WordPress site.

## Support and Contributions

If you encounter any issues or have suggestions for improvements, please [open an issue](https://github.com/rickhurst/vip-ip-blocker/issues). We welcome contributions from the community to make this plugin even better.

## License

VIP IP Blocker is released under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.en.html). Feel free to use and modify it according to the terms of the license.

---
**Note:** This plugin is provided as-is without any warranty. Always be cautious when blocking IP addresses, as it may affect legitimate users' access to your site.
```
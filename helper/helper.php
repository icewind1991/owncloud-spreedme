<?php
/**
 * ownCloud - spreedme
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Leon <leon@struktur.de>
 * @copyright Leon 2015
 */

namespace OCA\SpreedME\Helper;

use OCA\SpreedME\Settings\Settings;

class Helper {

	private function __construct() {

	}

	public static function getOwnHost() {
		$is_http = (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off');
		$protocol = ($is_http ? 'http' : 'https');
		$hostname = $_SERVER['SERVER_NAME'];
		$port = $_SERVER['SERVER_PORT'];
		$is_default_port = ($is_http && $port === '80') || (!$is_http && $port === '443');
		$optional_port = (!empty($port) && !$is_default_port ? ':' . $port : '');

		return $protocol . '://' . $hostname . $optional_port;
	}

	public static function getOwnAppVersion() {
		return \OCP\App::getAppVersion(Settings::APP_ID);
	}

	public static function getOwnAppPath() {
		return getcwd() . '/apps/' . Settings::APP_ID . '/';
	}

	public static function notifyIfAppNotSetUp() {
		if (!class_exists('\OCA\SpreedME\Config\Config', true) || !is_file(self::getOwnAppPath() . 'extra/static/config/OwnCloudConfig.js')) {
			die('You didn\'t set up this ownCloud app. Please follow the instructions in the README.md file in the apps/' . Settings::APP_ID . ' folder.');
		}
	}

}

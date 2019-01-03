<?php

namespace App\Services;

use App\User;
use InvalidArgumentException;

/**
 * Class ParserFactory
 *
 * @package App\Services
 */
final class ParserFactory
{
	/**
	 * @param User $user
	 * @return GpxParser|KmlParser
	 */
	public static function create(User $user) {
		$type = 'kml';

		if ($type == 'gpx') {
			return new GpxParser($user);
		}

		if ($type == 'kml') {
			return new KmlParser($user);
		}

		throw new InvalidArgumentException('Unknown format given');
	}
}

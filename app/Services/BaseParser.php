<?php

namespace App\Services;

use App\User;

/**
 * Class BaseParser
 *
 * @package App\Services
 */
abstract class BaseParser
{
	/**
	 * @var User
	 */
	public $user;

	/**
	 * @var array $data
	 */
	public $data;

	/**
	 * @var string $path
	 */
	public $path;

	/**
	 * BaseService constructor.
	 *
	 * @param User $user
	 * @param string $path
	 */
	public function __construct(User $user, string $path)
	{
		$this->user = $user;
		$this->path = $path;
	}
}

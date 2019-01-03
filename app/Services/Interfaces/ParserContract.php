<?php

namespace App\Services\Interfaces;

use App\Track;
use SimpleXMLElement;

interface ParserContract
{
	/**
	 * @return array
	 */
	public function parse(): array;

	/**
	 * @param SimpleXMLElement $data
	 * @return Track
	 */
	public function save(SimpleXMLElement $data): Track;
}
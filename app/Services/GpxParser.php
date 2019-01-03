<?php

namespace App\Services;

use App\Point;
use App\Services\Interfaces\ParserContract;
use App\Track;
use App\User;
use Carbon\Carbon;
use SimpleXMLElement;

/**
 * Class GpxParser
 *
 * @package App\Services\Reports
 */
class GpxParser extends BaseParser implements ParserContract
{
	/**
	 * GpxParser constructor.
	 *
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		parent::__construct($user, public_path('example.gpx'));
	}

	/**
	 * @return array
	 */
	public function parse(): array
	{
		$gpx = simplexml_load_file($this->path);
		$this->data = $this->save($gpx);

		return $this->data->toArray();
	}

	/**
	 * @param SimpleXMLElement $gpxData
	 * @return Track
	 */
	public function save(SimpleXMLElement $gpxData): Track
	{
		$track = new Track();
		$track->user_id = $this->user->id;
		$track->name = (string)$gpxData->trk->name;
		$track->attachment = $this->path;
		$track->save();

		foreach ($gpxData->trk->trkseg->trkpt as $trackPoint) {
			$point = new Point();
			$point->track()->associate($track);
			$point->altitude = (float)$trackPoint->ele;
			$point->longitude = (float)$trackPoint->attributes()->lon;
			$point->latitude = (float)$trackPoint->attributes()->lat;
			$point->tracked_at = Carbon::parse((string)$trackPoint->time);
			$point->displacement_sequence = (float)$trackPoint->ele;

			$point->save();
		}

		return $track->load(['user', 'points']);
	}
}

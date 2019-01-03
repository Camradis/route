<?php

namespace App\Services;

use App\Point;
use App\Services\Interfaces\ParserContract;
use App\Track;
use App\User;
use Carbon\Carbon;
use SimpleXMLElement;

/**
 * Class KmlParser
 *
 * @package App\Services\Reports
 */
class KmlParser extends BaseParser implements ParserContract
{
	/**
	 * GpxParser constructor.
	 *
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		parent::__construct($user, public_path('example.kml'));
	}

	/**
	 * @return array
	 */
	public function parse(): array
	{
		$kml = simplexml_load_file($this->path);
		$this->data = $this->save($kml);

		return $this->data->toArray();
	}

	/**
	 * @param SimpleXMLElement $kmlData
	 * @return Track
	 */
	public function save(SimpleXMLElement $kmlData): Track
	{
		$data = $kmlData->Document->Folder[1]->Folder;

		$track = new Track();
		$track->user_id = $this->user->id;
		$track->name = (string)$data->name;
		$track->attachment = $this->path;
		$track->save();

		foreach ($data->Folder->Placemark as $trackPoint) {
			$point = new Point();
			$point->track()->associate($track);
			$point->altitude = (float)explode(',',(string)$trackPoint->Point->coordinates)[2];
			$point->longitude = (float)$trackPoint->LookAt->longitude;
			$point->latitude = (float)$trackPoint->LookAt->latitude;
			$point->tracked_at = Carbon::parse((string)$trackPoint->TimeStamp->when);
			$point->displacement_sequence = $point->altitude;

			$point->save();
		}

		return $track->load(['user', 'points']);
	}
}

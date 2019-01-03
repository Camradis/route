<?php

namespace App\Http\Controllers;

use App\Services\ParserFactory;
use Illuminate\Contracts\Support\Renderable;

class TracksController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @return Renderable
	 */
	public function index()
	{
		$parser = ParserFactory::create(auth()->user());

		dd($parser->parse());

		return view('home');
	}
}

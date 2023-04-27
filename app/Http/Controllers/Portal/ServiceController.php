<?php

namespace App\Http\Controllers\portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Product;
use App\Models\GallaryPhoto;

class ServiceController extends Controller
{
	public function getEvent()
	{
		$events = Event::orderBy('id', 'DESC')->get();
		return view('portal.services.event', compact('events'));
	}

	public function getCourse()
	{
		$course = Event::orderBy('id', 'DESC')->get();
		return view('portal.services.course', compact('course'));
	}
}

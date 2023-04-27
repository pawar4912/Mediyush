<?php

namespace App\Http\Controllers\portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Product;
use App\Models\GallaryPhoto;
use App\Models\Course;

class ServiceController extends Controller
{
	public function getEvent()
	{
		$events = Event::orderBy('id', 'DESC')->get();
		return view('portal.services.event', compact('events'));
	}

	public function getCourse()
	{
		$course = Course::orderBy('id', 'DESC')->get();
		return view('portal.services.course', compact('course'));
	}

	// public function getNews()
	// {
	// 	$course = Course::orderBy('id', 'DESC')->get();
	// 	return view('portal.services.course', compact('course'));
	// }
}

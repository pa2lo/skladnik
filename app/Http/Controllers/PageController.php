<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
	/**
	 * File upload
	 */
	public function uploadFile(Request $request) {
		$file = $request->file('file')->store('files/images', 'public');

		return response(['location' => "/storage/$file"]);
	}
}
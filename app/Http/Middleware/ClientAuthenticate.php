<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ClientAuthenticate
{
	public function handle($request, Closure $next)
	{

		$user = Session::get('client_code');
		
		if (!isset($user)) {
			return redirect('/account');
		}

		return $next($request);
	}
}
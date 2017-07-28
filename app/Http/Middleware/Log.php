<?php

namespace App\Http\Middleware;

use Closure;
use App\Log as ModelLog;

class Log
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $server = $request->server->all();
        $data = [
            'ip'        => $request->getClientIp(),
            'time'      => $server['REQUEST_TIME'],
            'agent'     => $server['HTTP_USER_AGENT'],
            'host'      => $server['HTTP_HOST'],
            'scheme'    => @$server['REQUEST_SCHEME']?:'',
            'uri'       => $server['REQUEST_URI'],
        ];
        if ($data['uri'] !== '/log') {
            ModelLog::create($data);
        }
        return $next($request);
    }
}

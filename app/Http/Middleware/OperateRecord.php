<?php

namespace App\Http\Middleware;

use App\Models\OperateLog;
use Closure;

class OperateRecord
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
        OperateLog::query()->create([
            'user_id' => $request->user()->id,
            'uri' => $request->getUri(),
            'parameter' => http_build_query($request->except(['_token', '_method'])),
            'method' => $request->getMethod(),
        ]);
        return $next($request);
    }
}

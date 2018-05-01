<?php

namespace SCF\Http\Middleware;

use Closure;
use SCF\Models\Statistic;
use Illuminate\Http\Request;

class TrackStatistics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->guard($request)) {
            Statistic::visited($request);
        }

        return $next($request);
    }

    /**
     * Guard statistic tracking.
     *
     * @param Request $request
     *
     * @return bool
     */
    private function guard(Request $request)
    {
        // Early exit
        if (config('app.env') === config('stats.do_not_track_environment')) {
            return false;
        }
        // Only 'GET' method
        if (strtoupper($request->method()) !== 'GET') {
            return false;
        }
        // Do not track local ip
        if ($request->ip() === '127.0.0.1') {
            return false;
        }

        return $this->filterExclusions($request);
    }

    /**
     * Filter excluded routes.
     *
     * @param Request $request
     *
     * @return bool
     */
    private function filterExclusions(Request $request): bool
    {
        $routes = config('stats.excludes');

        foreach ($routes as $route) {
            if ($request->routeIs($route)) {
                return false;
            }
        }

        return true;
    }
}

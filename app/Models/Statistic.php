<?php

namespace SCF\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class Statistic extends Model
{
    /**
     * Every attribute but id is mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Record the visitation.
     *
     * @param Request $request
     *
     * @author Cali
     */
    public static function visited(Request $request)
    {
        $userAgent = new Agent();

        static::create([
            'referer'  => url()->previous(),
            'uri'      => $request->path(),
            'browser'  => $userAgent->browser(),
            'platform' => $userAgent->platform(),
            'device'   => $userAgent->device(),
            'ip'       => $request->ip(),
            'robot'    => $userAgent->isRobot() ? $userAgent->robot() : null,
            'user_id'  => optional($request->user())->id
        ]);
    }

}

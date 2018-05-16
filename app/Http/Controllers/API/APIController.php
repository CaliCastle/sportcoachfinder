<?php

namespace SCF\Http\Controllers\API;

use SCF\Models\Sport;
use Illuminate\Http\Request;
use SCF\Http\Controllers\Controller;

class APIController extends Controller
{
    /**
     * Get all sports.
     *
     * @return array
     */
    public function getSportsList()
    {
        $sports = Sport::defaultData();

        return $this->successResponse(compact('sports'));
    }
}

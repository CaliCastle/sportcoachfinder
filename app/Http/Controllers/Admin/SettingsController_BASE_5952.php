<?php

namespace SCF\Http\Controllers\Admin;

use SCF\Models\Site;
use Illuminate\Http\Request;
use SCF\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Update basic settings.
     *
     * @param Request $request
     *
     * @return array
     */
    public function updateBasic(Request $request)
    {
        $this->validate($request, [
            'siteTitle'   => 'required|string',
            'description' => 'required|string',
            'keywords'    => 'required|string'
        ]);

        return $this->updateSettings($request, true);
    }

    /**
     * Update SMTP settings.
     *
     * @param Request $request
     *
     * @return array
     */
    public function updateSmtp(Request $request)
    {
        $this->validate($request, [
            'adminEmailHost'     => 'required|string|url',
            'adminEmailPort'     => 'required|numeric',
            'adminEmailUsername' => 'required|string',
            'adminEmailPassword' => 'required'
        ]);

        return $this->updateSettings($request);
    }

    /**
     * Update settings by array.
     *
     * @param Request $request
     * @param bool    $redirect
     *
     * @return array
     */
    private function updateSettings(Request $request, $redirect = false): array
    {
        $requests = $request->all();

        foreach ($requests as $key => $value) {
            Site::$key($value);
        }

        $return = [
            'message' => 'Settings Updated',
        ];

        if ($redirect) {
            $return['redirect'] = route('admin.settings');
        }

        return $this->successResponse($return);
    }
}

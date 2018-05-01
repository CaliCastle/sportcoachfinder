<?php

return [

    /**
     * Environment that doesn't allow for tracking.
     */
    'do_not_track_environment' => 'local',

    /**
     * The route names to be excluded from statistics.
     */
    'excludes' => [
        'admin.*',
    ]
];
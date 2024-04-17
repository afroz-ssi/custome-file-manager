
<?php

function my_disk_list($disk_name)
{
    return [$disk_name];
}


function disksDetails($disk_name, $disk_path)
{
    $disk_name = [
        'Dr-1678791926' => [
            'driver' => 'local',
            'root' => public_path('Dr-1678791926'),
            'url' => env('APP_URL') . '/Dr-1678791926',
        ],
    ];
}

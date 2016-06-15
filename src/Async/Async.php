<?php
/**
 * this source file is Async.php
 *
 * author: shuc <shuc324@gmail.com>
 * time:   2016-06-07 15-12
 */
namespace Bileji\Support\Async;

use GearmanClient;

class Async
{
    protected $gearManClient = false;

    public function __construct()
    {
        global $gearManClient;
        if ($gearManClient == null) {
            $gearManClient = new GearmanClient();
            $gearManClient->addServers(implode(',', config('gearman')));
        }
        $this->gearManClient = $gearManClient;
    }

    public function __call($name, $arguments)
    {
        if (substr($name, 0, 3) == 'add') {
            if (false == $this->gearManClient) {
                return false;
            }
            $workload = ['method' => array_shift($arguments), 'payload' => $arguments];
            $this->gearManClient->doBackground(ucfirst(substr($name, 3) . 'Worker'), json_encode($workload));
            return $this->gearManClient->returnCode() != GEARMAN_SUCCESS ? false : true;
        } else {
            return false;
        }
    }
}

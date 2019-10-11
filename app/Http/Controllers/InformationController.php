<?php

namespace App\Http\Controllers;

use App\Information;

class InformationController extends Controller
{
    /**
     * Return array of statistics
     * @param  \App\Information  $information
     *
     * @return array
     */
    public function index(Information $information): array
    {
        $result = array();
        foreach ($information->getCount()->get() as $key => $value) {
            $result[$key]['slag'] = $value->link->slug;
            $result[$key]['total'] = $value->total;
        }

        return $result;
    }
}

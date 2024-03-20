<?php

namespace App\Interfaces\User;

use Illuminate\Http\Request;

interface StatisticInterface
{
    public function number_of_visits(Request $request);

    public function locations_for_link(Request $request);
}

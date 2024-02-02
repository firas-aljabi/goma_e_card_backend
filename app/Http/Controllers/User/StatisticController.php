<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\StatisticInterface;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    protected $statistic;

    public function __construct(StatisticInterface $statistic)
    {
        $this->statistic = $statistic;
    }

    public function number_of_visits(Request $request)
    {
        return $this->statistic->number_of_visits($request);
    }

    public function locations_for_link(Request $request)
    {
        return $this->statistic->locations_for_link($request);
    }
}

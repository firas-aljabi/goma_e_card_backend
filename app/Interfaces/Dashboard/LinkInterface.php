<?php

namespace App\Interfaces\Dashboard;

interface LinkInterface
{
    public function index();

    public function show($link);

    public function store($request);

    public function update($request, $link);

    public function delete($link);
}

<?php

namespace App\Interfaces\Dashboard;

use App\Models\Theme;

interface ThemeInterface
{
    public function index();

    public function show(Theme $theme);

    public function store($request);

    public function update($request, Theme $theme);

    public function delete(Theme $theme);
}

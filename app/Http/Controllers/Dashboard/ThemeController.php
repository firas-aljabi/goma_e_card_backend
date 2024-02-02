<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ThemeRequest;
use App\Interfaces\Dashboard\ThemeInterface;
use App\Models\Theme;

class ThemeController extends Controller
{
    protected $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->theme->index();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThemeRequest $request)
    {
        return $this->theme->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(Theme $theme)
    {
        return $this->theme->show($theme);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThemeRequest $request, Theme $theme)
    {

        return $this->theme->update($request, $theme);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        return $this->theme->delete($theme);

    }
}

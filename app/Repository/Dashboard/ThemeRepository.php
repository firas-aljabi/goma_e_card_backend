<?php

namespace App\Repository\Dashboard;

use App\Http\Resources\ThemeResource;
use App\Interfaces\Dashboard\ThemeInterface;
use App\Models\Theme;
use Illuminate\Support\Facades\File;

class ThemeRepository implements ThemeInterface
{
    public function index()
    {
        $themes = Theme::all();

        return ThemeResource::collection($themes);

    }

    public function store($request)
    {
        $theme = Theme::create($request->validated());

        return ThemeResource::make($theme);
    }

    public function show($theme)
    {
        return ThemeResource::make($theme);

    }

    public function update($request, Theme $theme)
    {
        File::delete(public_path($theme->image));

        $theme->update($request->validated());

        return ThemeResource::make($theme);
    }

    public function delete(Theme $theme)
    {
        File::delete(public_path($theme->image));
        $theme->delete();

        return response()->json(['message' => 'Deleted Successfully'], 404);
    }
}

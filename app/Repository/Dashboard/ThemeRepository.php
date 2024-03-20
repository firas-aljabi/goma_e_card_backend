<?php

namespace App\Repository\Dashboard;

use App\Http\Resources\ThemeResource;
use App\Interfaces\Dashboard\ThemeInterface;
use App\Models\Color;
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

        return $this->StoreColor($request, $theme);
    }

    public function show($theme)
    {
        return ThemeResource::make($theme);

    }

    public function update($request, Theme $theme)
    {
        File::delete(public_path($theme->image));

        $theme->update($request->validated());

        return $this->StoreColor($request, $theme);
    }

    public function delete(Theme $theme)
    {
        File::delete(public_path($theme->image));
        $theme->delete();

        return response()->json(['message' => 'Deleted Successfully'], 404);
    }

    public function StoreColor($request, Theme $theme): ThemeResource
    {
        if (isset($request->colors)) {

            $colors = [];
            foreach ($request->colors as $index => $colorname) {
                $color = Color::where('name', $colorname)->first();
                if (! $color) {
                    $color = Color::create(['name' => $colorname]);
                }
                $colors[$index] = $color->id;
            }
            $theme->colors()->sync($colors);
        }

        return ThemeResource::make($theme);
    }
}

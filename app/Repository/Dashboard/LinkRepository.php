<?php

namespace App\Repository\Dashboard;

use App\Http\Resources\PrimaryLinkResource;
use App\Interfaces\Dashboard\LinkInterface;
use App\Models\PrimaryLink;
use Illuminate\Support\Facades\File;

class LinkRepository implements LinkInterface
{
    public function index()
    {
        $links = PrimaryLink::all();

        return PrimaryLinkResource::collection($links);

    }

    public function store($request)
    {
        $link = PrimaryLink::create($request->validated());

        return PrimaryLinkResource::make($link);

    }

    public function show($id)
    {
        $link = PrimaryLink::findOrFail($id);

        return PrimaryLinkResource::make($link);

    }

    public function update($request, $id)
    {
        $link = PrimaryLink::findOrFail($id);
        File::delete(public_path($link->logo));

        $link->update($request->validated());

        return PrimaryLinkResource::make($link);
    }

    public function delete($id)
    {
        $link = PrimaryLink::findOrFail($id);
        File::delete(public_path($link->logo));
        $link->delete();

        return response()->json(['message' => 'Deleted Successfully'], 404);
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PrimaryLinkRequest;
use App\Interfaces\Dashboard\LinkInterface;

class LinkController extends Controller
{
    protected $link;

    public function __construct(LinkInterface $link)
    {
        $this->link = $link;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->link->index();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrimaryLinkRequest $request)
    {
        return $this->link->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $primaryLink)
    {

        return $this->link->show($primaryLink);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrimaryLinkRequest $request, string $primaryLink)
    {
        return $this->link->update($request, $primaryLink);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->link->delete($id);

    }
}

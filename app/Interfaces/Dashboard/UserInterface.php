<?php

namespace App\Interfaces\Dashboard;

use App\Models\User;

interface UserInterface
{
    public function index();

    public function show(User $user);

    public function store($request);

    public function update($request, User $user);

    public function delete(User $user);
}

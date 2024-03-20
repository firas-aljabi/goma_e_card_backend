<?php

namespace App\Interfaces\User;

use App\Models\User;

interface ProfileInterface
{
    public function show(User $user);

    public function visit($request);

    public function update($request);

    public function store_personal_data($request);

    public function store_links($request);

    public function store_other_data($request);

    public function store_theme($request);
}

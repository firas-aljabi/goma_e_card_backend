<?php

namespace App\Repository\Dashboard;

use App\Http\Resources\UserResource;
use App\Interfaces\Dashboard\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);

    }

    public function store($request)
    {
        $request->validated();

        $user = User::create(array_merge($request->except('password'),
            ['password' => md5($request->password)]
        ));

        return UserResource::make($user);
    }

    public function show(User $user)
    {
        return UserResource::make($user);

    }

    public function update($request, User $user)
    {
        $user->update(array_merge($request->except('password'),
            ['password' => md5($request->password)]
        ));

        return UserResource::make($user);
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Deleted Successfully'], 404);
    }
}

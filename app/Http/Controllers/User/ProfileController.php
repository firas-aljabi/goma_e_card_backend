<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\CreateProfile\step1ProfileRequest;
use App\Http\Requests\user\CreateProfile\step2ProfileRequest;
use App\Http\Requests\user\CreateProfile\step3ProfileRequest;
use App\Http\Requests\user\CreateProfile\step4ProfileRequest;
use App\Http\Requests\user\EditProfileRequest;
use App\Http\Requests\user\VisitProfileRequest;
use App\Interfaces\User\ProfileInterface;
use App\Models\User;

class ProfileController extends Controller
{
    protected $profile;

    public function __construct(ProfileInterface $profile)
    {
        $this->profile = $profile;
    }

    public function store_personal_data(step1ProfileRequest $request)
    {
        return $this->profile->store_personal_data($request);
    }

    public function store_links(step2ProfileRequest $request)
    {
        return $this->profile->store_links($request);
    }

    public function store_other_data(step3ProfileRequest $request)
    {
        return $this->profile->store_other_data($request);
    }

    public function store_theme(step4ProfileRequest $request)
    {
        return $this->profile->store_theme($request);
    }

    public function show(User $user)
    {
        return $this->profile->show($user);
    }

    public function update(EditProfileRequest $request)
    {
        return $this->profile->update($request);
    }

    public function visit(VisitProfileRequest $request)
    {
        return $this->profile->visit($request);
    }
}

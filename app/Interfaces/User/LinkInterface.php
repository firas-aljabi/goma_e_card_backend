<?php

namespace App\Interfaces\User;

interface LinkInterface
{
    public function visit($user, $primaryLink, $request);

    public function destroy($user, $primaryLink);
}

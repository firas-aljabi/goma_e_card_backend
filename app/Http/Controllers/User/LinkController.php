<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\LinkInterface;
use App\Models\User;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    protected $link;

    public function __construct(LinkInterface $link)
    {
        $this->link = $link;
    }

    public function visit(User $user, $primaryLink,Request $request)
    {
        return $this->link->visit($user, $primaryLink,$request);
    }

    public function destroy(User $user, $primaryLink)
    {
        return $this->link->destroy($user, $primaryLink);
    }
}

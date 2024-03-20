<?php

namespace App\Repository\User;

use App\Interfaces\User\LinkInterface;
use App\Models\ProfilePrimaryLink;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LinkRepository implements LinkInterface
{
    public function visit($user, $primaryLink, $request)
    {
        $primaryLink = $user->primary->where('id', $primaryLink)->first();
        if (! $primaryLink) {
            return response(['msg' => 'Primary link not found for this profile'], 404);
        }

        $ProfilePrimaryLink = ProfilePrimaryLink::where('primary_link_id', $primaryLink->id)
            ->where('user_id', $user->id)
            ->first();

        if ($ProfilePrimaryLink) {
            DB::select('CALL insert_user_primary_links_views(?, ?, ?, ?)', [$user->id, $primaryLink->id, $request->address, Carbon::now()]);

            return response()->json(['success' => 'success'], 201);
        } else {
            // Handle the case where the ProfilePrimaryLink is not found
            return response(['msg' => 'ProfilePrimaryLink not found'], 404);
        }
    }

    public function destroy($user, $primaryLink)
    {
        $primaryLink = $user->primary->where('id', $primaryLink)->first();
        if (! $primaryLink) {
            return response(['msg' => 'Primary link not found for this profile'], 404);
        }

        $ProfilePrimaryLink = ProfilePrimaryLink::where('primary_link_id', $primaryLink->id)
            ->where('user_id', $user->id)
            ->first();

        if ($ProfilePrimaryLink) {
            $ProfilePrimaryLink->delete();

            return response(['msg' => 'deleted successfully']);
        } else {
            // Handle the case where the ProfilePrimaryLink is not found
            return response(['msg' => 'ProfilePrimaryLink not found'], 404);
        }
    }
}

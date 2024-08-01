<?php

namespace App\Http\Controllers\API\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AvatarController extends Controller
{
    use FileUpload;
    public function addAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $user = auth('customer')->user();

            $avatar = $request->file('avatar');

            $avatar_name = $this->generateRandomString() . '.' . $avatar->getClientOriginalExtension();

            $profile = DB::table('customers_profile')->where('customer_id', $user->id)->first();

            $old_avatar = $profile ? $profile->avatar : null;

            // $path = $avatar->storeAs('uploads/avatars', $avatar_name, 'public');

            $path = $this->uploadImage($avatar, $avatar_name, 'uploads/avatars/');

            if ($profile) {
                //!TODO Update the avatar in the user's profile
                DB::table('customers_profile')->where('customer_id', $user->id)->update([
                    'avatar' => $avatar_name,
                ]);

                if ($old_avatar && Storage::disk('public')->exists('uploads/avatars/' . $old_avatar)) {
                    Storage::disk('public')->delete('uploads/avatars/' . $old_avatar);
                }

                return response()->json(['message' => 'Avatar updated successfully', 'path' => $path], 200);
            } else {

                //!TODO Insert a new profile with the avatar
                DB::table('customers_profile')->insert([
                    'customer_id' => $user->id,
                    'avatar' => $avatar_name,
                ]);
                return response()->json(['message' => 'Avatar added successfully', 'path' => $path], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upload avatar', 'message' => $e->getMessage()], 500);
        }
    }

    protected function generateRandomString()
    {
        $minLength = 50;
        $maxLength = 70;
        $length = rand($minLength, $maxLength);
        return Str::random($length);
    }
}


//http://localhost:8000/storage/uploads/avatars/Images*  customers_profile_user_id_foreign






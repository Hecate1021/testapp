<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Events;
use App\Models\Post;
use App\Models\Review;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index($id = 2)
    {
        // Check if the user is logged in
        if (auth()->check()) {
            $authUserId = auth()->user()->id;

            // Fetch users who have messages with the authenticated user and count unread messages
            $users = User::where('id', '!=', $authUserId)
                ->whereHas('messages', function ($query) use ($authUserId) {
                    $query->where('sender_id', $authUserId)
                          ->orWhere('receiver_id', $authUserId);
                })
                ->withCount(['messages' => function ($query) use ($authUserId) {
                    $query->where('receiver_id', $authUserId)->where('is_read', false);
                }])
                ->get();
        } else {
            // If the user is not logged in, set users to an empty collection
            $users = collect(); // Empty collection
        }

        // Fetch the resort user by id
        $user = User::where('id', $id)
            ->where('role', 'resort')
            ->with('userinfo')
            ->firstOrFail();

        // Fetch the rooms for the resort user
        $rooms = Room::with('images')->where('user_id', $user->id)->get();
        $events = Events::with('eventImages')->get();
        $categories = Category::with('subcategories.menus.images')->get();
        $reviews = Review::with('user')->get();

        // Return the view with the required data
        return view('balai', compact('user', 'rooms', 'users','events','categories', 'reviews'));
    }



    public function dashboard()
    {

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('dashboard');
    }
    // public function welcome()
    // {
    //     $users = User::where('role', 'resort')->with('userInfo')->get();
    //     return view('balai', compact('users'));
    // }
    public function resort($name) {
        // Fetch the user by name and ensure the user is a resort
        $user = User::where('name', $name)->where('role', 'resort')->with('userinfo')->firstOrFail();

        // Check if the authenticated user is the owner of the profile
        $isOwner = Auth::check() && Auth::id() === $user->id;

        // Fetch reviews for the specified user and calculate the average rating
        $averageRating = Review::where('resort_id', $user->id)->avg('rating');

        // Ensure the average rating does not exceed 5
        $averageRating = min($averageRating, 5);

        // Fetch posts for the specified user with their associated files
        $posts = Post::where('user_id', $user->id)->with('files')->get();

        return view('resort.resort-profile', compact('user', 'isOwner', 'averageRating', 'posts'));
    }


    public function resortRoom($name)
    {
        $user = User::where('name', $name)->where('role', 'resort')->with('userinfo')->first();
        $isOwner = false;
        // Fetch reviews for the resort user and calculate the average rating
        $averageRating = Review::where('resort_id', $user->id)->avg('rating');

        // Ensure the average rating does not exceed 5
        $averageRating = min($averageRating, 5);
        $rooms = Room::with('images')->where('user_id', $user->id)->get();
        return view('resort.room', compact('user', 'isOwner', 'rooms', 'averageRating'));
    }

    public function accomodation(){
        return view('accomodation');
    }
}

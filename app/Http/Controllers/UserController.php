<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\review;
use App\Models\tool;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(User $user): View
    {
        $tools = $user->tools;
        $userId = $user->id;
        $reviews = review::where('reviewed_user_id', '=', $userId)->latest()->get();
        $currentUser = Auth()->user();
        

        return view('tools.userProfile')->with('user', $user)->with('tools', $tools)->with('reviews', $reviews)->with('currentUser', $currentUser);
    }

    public function banpage(User $user): View
    {
        if(Auth()->user()->isAdmin)
        {
            return view('tools.banUser')->with('user', $user);
        }
        abort(403, 'You are not an administrator');
    }

    public function ban(Request $request, User $user): RedirectResponse
    {
        if(Auth()->user()->isAdmin)
        {
            $time = $request->banDuration;
            $bannedUntil = Carbon::now()->adddays($time);
            $user->update(['banned_until' => $bannedUntil]);
            return redirect(route('dashboard'));
        }
        abort(403, 'You are not an administrator');
        
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\tool;
use App\Models\loan;
use App\Models\category;
use App\Models\review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): view
    {
        $tools = tool::where('user_id', '=', auth()->id())->latest()->get();
        $categories = category::get();

        return view('tools.index', compact('tools'), compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|file|mimes:png,jpeg,jpg|max:2048',
            'description' => 'required|string|max:255',
            'category' => 'required',
        ]);

        $category = DB::table('categories')->where('name', '=', $request->category)->get('id');
        
        $tool = $request->user()->tools()->create(['name' => $validated['name'], 'description' => $validated['description'], 'category_id' => $category[0]->id]);

        $image_name = time().'.'.Str::random(5).'.'.$request->url->extension();
        $request->url->move(public_path('images'), $image_name);       

        $tool->image()->create(['url' => $image_name]);

        return redirect(route('tools.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tool $tool): View
    {
        $this->authorize('update', $tool);
        
        return view('tools.edit', [
            'tool' => $tool,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tool $tool): RedirectResponse
    {
        $this->authorize('update', $tool);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        
        $tool->update($validated);

        return redirect(route('tools.index'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tool $tool)
    {
        //
    }

    //custom functions

    public function dashboard(): view
    {
        $currentUser = auth()->id();
        $loans = loan::where('user_id', '=', $currentUser)
            ->latest()
            ->get();       
        $tools = [];
        foreach($loans as $loan){
            array_push($tools, $loan->tool);
        }


        $myTools = tool::where('user_id', '=', $currentUser)
            ->whereIn('id', function($query) {
                $query->select('tool_id')
                    ->from('loans');
            })
            ->latest()
            ->get();

        $myReviews = review::where('user_id', '=', $currentUser)
            ->latest()
            ->get();

        $reviewsAM = review::where('reviewed_user_id', '=', $currentUser)
            ->latest()
            ->get();
        
        return view('dashboard', compact('tools'), compact('myTools'))->with('myReviews', $myReviews)->with('reviewsAM', $reviewsAM);
    }

    public function allTools(Request $request): view
    {
        $search = $request->search;
        $category = $request->category;
        $currentCategory = 'none';
        $tools = tool::where('user_id', '!=', auth()->id())
            ->when($category != 'none' and $category != null, function($query) use($category) {
                
                $id = DB::table('categories')->where('name', '=', $category)->get('id');
                
                $query->where('category_id', $id[0]->id);
            })
            ->when($search != null, function($query) use($search) {
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->where('user_id', '!=', auth()->id());
            })
            ->whereNotIn('id', function($query) {
                $query->select('tool_id')
                    ->from('loans');
            })
            ->whereNotIn('user_id', function($query) {
                $query->select('id')
                    ->from('users')
                    ->where('banned_until', '>', now()); // Check if user is not banned
            })
            ->latest()
            ->get();
        if($category != 'none' and $category != null){
            $currentCategory = $category;
        }
        $categories = category::get();
        return view('tools.allTools', compact('tools'), compact('categories'))->with('currentCategory', $currentCategory);
    }

    public function destroyLoan(Request $request, tool $tool): RedirectResponse
    {
        $this->authorize('delete', $tool);
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);
        $loan = $tool->loan;
        $reviewedUser = $loan->user->id;
        $review = $request->user()->reviews()->create(['reviewed_user_id' => $reviewedUser, 'content' =>$validated['content']]);
        
        

        $loan->delete();

        return redirect(route('tools.dashboard'));
    }

    public function review(tool $tool): View
    {

        
        return View('tools.review', [
            'tool' => $tool,
        ]);
    }

}


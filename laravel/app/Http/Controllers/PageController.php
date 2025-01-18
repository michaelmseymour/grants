<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Round;
use App\Models\Application;
use App\Models\Judged;

use Carbon\Carbon;

class PageController extends Controller
{
    // Display different home page views if you're logged in or out
    public function home()
    {
        $ongoing = Round::ongoing();
        $upcoming = Round::upcoming();

        if($this->auth->check())
        {
            if(in_array($this->auth->user()->role, ['judge', 'kitten', 'observer']))
            {
                // Get all applications where the application is submitted and the judge has not submitted a score(judged).
                // TODO: There should be a way to make this work with a single eloquent db access via a left join
                $judgedapps = Judged::where('user_id', '=', Auth::user()->id)->pluck('application_id')->toArray();
                $applications = Application::whereIn('applications.status', ['submitted', 'review'])
                    ->whereNotIn('applications.id', $judgedapps)
                    ->get();
            }
            else
            {
                $applications = $this->auth->user()->applications;
            }

            $rounds = Round::orderBy('start_date', 'desc')->get();
            return view('pages/dashboard', compact('applications', 'ongoing', 'upcoming', 'rounds'));
        }
        else
        {
            $featured = new Collection;
            $featured = $featured->concat($ongoing);
            $featured = $featured->concat($upcoming);

            return view('pages/home', compact('featured'));
        }
    }

    // General purpose function for displaying views
    public function view(Request $request)
    {
        return view('pages/' . $request->path());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company, Request $request)
    {
        Comment::create([
            'body'=>\request('body'),
            'company_id'=> $company->id,
            'user_id'=>Auth::id()
        ]);
        return back();
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Information;
use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Http\Requests\LinkRequest  $request
     * @param  \App\Link  $link
     * @param  \App\Information  $information
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request, Link $link, Information $information)
    {
        $model = $link->returnLinkBySlug($request->slug);
        $information->saveRequest($request, $model->id);
        return redirect($model->link);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LinkRequest  $request
     * @return \App\Link
     */
    public function store(LinkRequest $request): Link
    {
        $link = Link::create($request->validated());

        return $link;
    }

}

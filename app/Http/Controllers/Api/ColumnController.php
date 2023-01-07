<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TrelloResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Http\Requests\StoreColumnRequest;
use App\Http\Requests\UpdateColumnRequest;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return TrelloResource::collection($request->user()->columns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreColumnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColumnRequest $request)
    {
        $order = $request->user()->columns->max('order')+1 ?? 1;
        $column = $request->user()->columns()->create([
            'title' => $request->title,
            'order' => $order
        ]);

        return Request::success('Column created successfully', $column);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateColumnRequest  $request
     * @param  \App\Models\Column  $column
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColumnRequest $request, Column $column)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Column  $column
     * @return \Illuminate\Http\Response
     */
    public function destroy(Column $column)
    {
        //
    }
}

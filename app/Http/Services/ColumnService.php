<?php


namespace App\Http\Services;


use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColumnService
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return collection
     */
    public function getAll($request)
    {
        return $request->user()->columns()->with('cards')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function store($request)
    {
        $order = $request->user()->columns->max('order')+1 ?? 1;
        return $request->user()->columns()->create([
            'title' => $request->title,
            'order' => $order
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $column
     * @return \Illuminate\Support\Collection
     */
    public function update($request, $column)
    {
        $column->title = $request->title;

        if (!empty($request->order))
            $column->order = $request->order;

        $column->save();

        ///
        if (!empty($request->order)){
            $this->syncColumnsOrder($request->order, $column);
        }
        return $column;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $column
     * @return \Illuminate\Support\Collection
     */
    public function delete($column)
    {
        $column->cards()->delete();
        $column->delete();
        $this->resetUsersColumnsOrder($column->user_id);
    }

    public function syncColumnsOrder($order, $column)
    {
        DB::statement("SET @number = ".$order.";");
        DB::statement("update `columns` SET `order`= (@number := @number + 1) WHERE `order` >= ".$order." and id <> ".$column->id." and user_id = ".$column->user_id.";");
    }

    public function resetUsersColumnsOrder($user_id)
    {
        $columns = Column::where('user_id', $user_id)->get();
        $order = 0;
        foreach ($columns as $column){
            $order++;
            $column->order = $order;
            $column->save();
        }
    }

}

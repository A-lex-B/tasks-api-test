<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function create(CreateRequest $request)
    {
        return new TaskResource(Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'complete_till' => $request->complete_till
        ]));
    }

    public function read(int $id)
    {
        return new TaskResource(Task::findOrFail($id));
    }

    public function update(UpdateRequest $request)
    {
        $task = Task::findOrFail($request->id);
        $task->update($request->safe()->except('id'));

        return new TaskResource($task);
    }

    public function delete(DeleteRequest $request)
    {
        Task::findOrFail($request->id)->delete();
        return TaskResource::collection(Task::all());
    }

    public function list(ListRequest $request)
    {
        $query = Task::query();

        $request->whenFilled('search.status', function($status) use ($query) {
            $query->where('status', $status);
        });

        $request->whenFilled('search.complete_till', function($completeTill) use ($query) {
            $completeTill = Carbon::createFromTimestamp($completeTill)->toDateTimeString();
            $query->where('complete_till', $completeTill);
        });

        return TaskResource::collection($query->get());
    }
}

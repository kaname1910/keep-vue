<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function index(Request $request) {
    	
    	$tasks = Task::orderBy('id','desc')->paginate(3);

    	return [
            'pagination' => [                
                'total' => $tasks->total(),
                'current_page' => $tasks->currentPage(),
                'per_page' => $tasks->perPage(),
                'last_page' => $tasks->lastPage(),
                'from' => $tasks->firstItem(),
                'to' => $tasks->lastItem(),
            ],
            'tasks' => $tasks
        ];
    }

    public function store(Request $request) {
        $this->validate($request, [
            'keep' => 'required'
        ]);

        Task::create($request->all());

        return;
    }

    public function edit($id) {
    	$task = Task::findOrFail($id);
    	return $task;
    }

    public function update(Request $request, $id) {

        $this->validate($request, [
            'keep' => 'required'
        ]);

        $task = Task::find($id);
        $task->fill($request->all());
        $task->save();

        return;
    }


    public function destroy($id) {
    	$task = Task::findOrFail($id);
    	$task->delete();
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page(Request $request)
    {

        $start = $request->get('start');
        $length = $request->get('length');
		$search_arr = $request->get('search');
        $searchValue = $search_arr['value'];
        $tasks = Task::select('*')
		->where('task_description', 'like', '%' . $searchValue . '%')
		->skip($start)
        ->take($length)
        ->get();

        $data_arr = array();

        foreach($tasks as $t){
            $description = $t->task_description;
            $deadline = $t->deadline;
            $categories = DB::table('category_task')->select('categories.name')
            ->join('tasks', 'tasks.id', '=', 'category_task.task_id')
            ->join('categories', 'categories.id', '=', 'category_task.category_id')
            ->where('category_task.task_id', '=', $t->id)->get();
            $assign = User::find($t->assign)->name;
            $data_arr[] = array(
                "description" =>$description,
                "deadline" => $deadline,
                "categories" => $categories,
                "assign" => $assign,
                "action"=>"<a href='task/".$t->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i> Edit</a>
                <a href='task/".$t->id."/deleted'  class='btn btn-danger'><i class='fas fa-trash'></i> Delete </a>
                <a href='task/".$t->id."' class='btn btn-info'><i class='fas fa-info'></i> View </a>

                "

        );
        }
		$total_members=Task::count();
        $count=DB::select("select * from tasks where task_description like '%".$searchValue."%'");
        $recordsFiltered=count($count);
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data_arr,
        );

        echo json_encode($data);
    }



    public function index()
    {
        return view('task.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('task.create',["users"=>$users,"categories"=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'task_description' => 'required',
        ]);

        $task=new Task();
		$task->task_description=$request->task_description;
		$task->create_date=$request->create_date;
		$task->deadline=$request->deadline;
		$task->sub_tasks=$request->sub_tasks;
		$task->end_flag=$request->end_flag;
		$task->assign=$request->assign;
        $task->save();
        $task->Categories()->attach($request->category_id);
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view("task.show",["task"=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $categories = Category::all();
        $users = User::all();
        return view("task.edit",["users"=>$users,"task"=>$task,"categories"=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->task_description=$request->task_description;
		$task->create_date=$request->create_date;
		$task->deadline=$request->deadline;
		$task->sub_tasks=$request->sub_tasks;
		$task->end_flag=$request->end_flag;
		$task->assign=$request->assign;
        $task->save();
        $task->Categories()->sync($request->category_id);
		return redirect()->route("task.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function deleted($id)
    {
		$task=Task::find($id);
		$task->delete();
		return redirect()->route("task.index");
    }

    public function sendEmail(Request $request){
        try {
            $emails = DB::select('select email,name from users');
            if($emails[0]->email == null){
                return redirect()->back;
            }else{
                $email=($emails[0]->email);
                emailJob::dispatch($email,$emails);
                return redirect();
            }
        }
            catch (Exception $e) {
                return redirect()->back;
            }

    }
}

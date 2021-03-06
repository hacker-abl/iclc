<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Response;

class Item_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if($this->user->role !== 1){
                return redirect('/unauthorized');
            }
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Responseg
     */
    public function index()
    {    	
        $data = array(
            'semester' => DB::table('semester')->get(), 
            'department' => DB::table('department')->get(), 
            'acadyear' => DB::table('school_year')->get(), 
            );

        return view('pages/item', $data);
    }

    public function item(Request $request, $option){
    	if($option === 'add'){
    		$this->validate($request, [
	            'itemName' => 'required|max:255',
                'itemAmount' => 'required|max:255',
                'academicYear' => 'required|max:255',
                'semester' => 'required|max:255',
                'department' => 'required|max:255',
                'itemStatus' => 'required|max:255'
    			]);

    		$data = [
                'description' => $request->itemName,
                'department_id' => $request->department,
                'semester_id' => $request->semester,
                'sy_id' => $request->academicYear,
                'option' => $request->itemStatus,
                'amount' => $request->itemAmount
	        ];

            $insert = DB::table('item')
            ->insertGetId($data);

            if($insert){
                $data = array(
                    'id' => $insert,
                    'name' => $request->itemName,
                    'amount' => $request->itemAmount,
                    'status' => $request->itemStatus
                );
                echo json_encode($data);
            }
    	}else if($option === 'update'){
            $this->validate($request, [
                'update-item-id' => 'required|max:255',
                'update-item-name' => 'required|max:255',
                'update-item-price' => 'required|max:255',
                'update-item-status' => 'required|max:255',
                ]);

            $data = [
                'description' => $request['update-item-name'],
                'amount' => $request['update-item-price'],
                'option' => $request['update-item-status'],
            ];

            DB::table('item')
            ->where('id', $request['update-item-id'])
            ->update($data);

            echo json_encode($data);
        }else if($option === 'delete'){
            $this->validate($request, [
                'item_id' => 'required|max:255'
                ]);

            $item_id = array_map('intval', explode(',', $request->item_id));

            $item = DB::table('item')
                        ->whereIn('id', $item_id)
                        ->delete();


            echo json_encode($item);
        }
    }

    public function item_list()
    {
    	$data = array();
        //join balance and student information table;
        $item = DB::table('item')->get();
        if($item){
        	foreach ($item as $key => $value) {
                $data[$key][] = $item[$key]->id;
                $data[$key][] = $item[$key]->semester_id;
                $data[$key][] = $item[$key]->sy_id;
	            $data[$key][] = $item[$key]->description;
                $data[$key][] = $item[$key]->amount;
                if($item[$key]->option === 1){
                    $data[$key][] = "Yes";
                }else if($item[$key]->option === 0){
    	            $data[$key][] = "No";
                }
	            // $data[$key][] = $item[$key]->sy_id;
	            // $data[$key][] = $item[$key]->semester_id;
	            // $data[$key][] = $item[$key]->created_at;
	            // $data[$key][] = $item[$key]->updated_at;
	        }
        }

        $table_data = array(
            "draw" => 1,
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            'data' => $data, 
            );

        echo json_encode($table_data);
    }

    public function search_by_id($id){
        $item = DB::table('item')
            ->where('id', $id)
            ->get();

        echo json_encode($item);
    }

    public function test(Request $request, $id){
        if($id == 1){
            echo 'dadsa';
            $request->session()->flash('status', 'Task was successful!');
            dd($request->session()->get('status'));
        }else{
            dd($request->session()->get('status'));
        }
    }
}

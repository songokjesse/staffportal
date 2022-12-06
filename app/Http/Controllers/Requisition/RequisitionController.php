<?php

namespace App\Http\Controllers\Requisition;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Requisition;
use App\Models\RequisitionAssignment;
use App\Models\RequisitionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class RequisitionController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $requisitions = DB::table('requisitions')
            ->join('departments', 'requisitions.department_id', '=', 'departments.id')
            ->select('requisitions.total','requisitions.description','requisitions.status','requisitions.id','departments.name as name')
            ->where('user_id', '=', $user_id)
            ->get();
        return view('requisition.index', compact('requisitions'));
    }


    public function create()
    {
        $departments = Department::all();
        return view('requisition.create', compact('departments'));
    }


    public function store(Request $request){
        $request->validate([
           'description' => 'required',
           'from_department_id' => 'required',
           'to_department_id' => 'required',
           'title' => 'required',
           'total_amount' => 'required'
        ]);
        //destructure request
        //requisition general information
        $user_id = Auth::user()->id;
        $description = $request['description'];
        $from_department_id = $request['from_department_id'];
        $to_department_id = $request['to_department_id'];
        $title = $request['title'];
        $total_amount = $request['total_amount'];


        $requisition = new Requisition();
        $requisition->total = $total_amount;
        $requisition->status = "Pending";
        $requisition->title = $title;
        $requisition->description = $description;
        $requisition->department_id = $from_department_id;
        $requisition->user_id = $user_id;
        $requisition->save();
        // Count the number of items
        $count = count($request['item_name']);

        //add items to database
        for ($i=0; $i < $count; $i++) {
            $item = new RequisitionItem();
            $item->requisition_id = $requisition->id;
            $item->item_name = $request->item_name[$i];
            $item->item_quantity = $request->item_quantity[$i];
            $item->total_cost = $request->total_cost[$i];
            $item->unit_cost = $request->unit_cost[$i];
            $item->save();
        }

        //add item to requisition_assignments
        $req_assignment = new RequisitionAssignment();
        $req_assignment->requisition_id = $requisition->id;
        $req_assignment->status = "Pending";
        $req_assignment->department_id = $to_department_id;
        $req_assignment->save();


        return redirect()->route('requisitions.index')
            ->with('status','Requisition Created successfully.');
    }

    public function show($id){
        $requisition = DB::table('requisitions')
            ->join('departments', 'requisitions.department_id', '=', 'departments.id')
            ->select(
                'requisitions.total',
                'requisitions.description',
                'requisitions.title',
                'requisitions.status',
                'requisitions.id',
                'requisitions.created_at',
                'departments.name as from_department',
            )
            ->where('requisitions.id', '=', $id)
            ->get();
       $requisition_items = DB::table('requisition_items')
           ->join('requisitions', 'requisition_items.requisition_id', '=', 'requisitions.id')
           ->select(
               'requisition_items.item_name',
               'requisition_items.item_quantity',
               'requisition_items.unit_cost',
               'requisition_items.total_cost',
           )
           ->where('requisition_items.requisition_id', '=', $id)
           ->get();

        $to_department = DB::table('requisition_assignments')
            ->join('departments', 'requisition_assignments.department_id', '=', 'departments.id')
           ->select('departments.name as to_department_name')
           ->where('requisition_assignments.requisition_id', '=', $id)
           ->get();

        return view('requisition.show', compact('requisition', 'requisition_items','to_department'));
    }

    public function createPDF($id){
        $requisition = DB::table('requisitions')
            ->join('departments', 'requisitions.department_id', '=', 'departments.id')
            ->select(
                'requisitions.total',
                'requisitions.description',
                'requisitions.title',
                'requisitions.status',
                'requisitions.id',
                'requisitions.created_at',
                'departments.name as from_department',
            )
            ->where('requisitions.id', '=', $id)
            ->get();
        $requisition_items = DB::table('requisition_items')
            ->join('requisitions', 'requisition_items.requisition_id', '=', 'requisitions.id')
            ->select(
                'requisition_items.item_name',
                'requisition_items.item_quantity',
                'requisition_items.unit_cost',
                'requisition_items.total_cost',
            )
            ->where('requisition_items.requisition_id', '=', $id)
            ->get();

        $to_department = DB::table('requisition_assignments')
            ->join('departments', 'requisition_assignments.department_id', '=', 'departments.id')
            ->select('departments.name as to_department_name')
            ->where('requisition_assignments.requisition_id', '=', $id)
            ->get();


//            return view('requisition.createPDF', compact('requisition', 'requisition_items','to_department'));
//        view()->share('requisition.createPDF', compact('requisition', 'requisition_items','to_department'));
        $pdf = PDF::loadView('requisition.createPDF',compact('requisition', 'requisition_items','to_department'));
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function make_requisition(){
        $departments = Department::all();
        return view('requisition.make_requisition', compact('departments'));
    }

}

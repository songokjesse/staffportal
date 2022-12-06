<?php

namespace App\Http\Livewire;

use App\Models\RequisitionItem;
use Livewire\Component;

class MakeRequisition extends Component
{
    public  $item_name;
    public  $item_quantity;
    public  $unit_cost;
    public  $total_amount;
    public  $total_cost;
    public $departments;
    public $i = 0;
    public $inputs = [];

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        $this->inputs[] = $i;
    }
    public function remove($i)
    {
//        remove the total_cost from the total amount
        $this->total_amount = $this->total_amount-$this->total_cost[$i];
        //        remove the input on delete
        unset($this->inputs[$i]);

    }


    public function updated($key, $value)
    {
        if(in_array($key, ['total_cost.'.$key[strlen($key)-1]])){
            $this->total_amount = array_sum($this->total_cost);
        }
    }
    public function store()
    {
        $validatedDate = $this->validate([
            'item_name.0' => 'required',
            'item_quantity.0' => 'required',
            'unit_cost.0' => 'required',
            'total_cost.0' => 'required',
            'item_name.*' => 'required',
            'item_quantity.*' => 'required',
            'unit_cost.*' => 'required',
            'total_cost.*' => 'required',
        ]);
        dd($validatedDate);

    }

    public function render()
    {
        return view('livewire.make-requisition');
    }
    public function mount()
    {
        $this->requisition_items = new RequisitionItem();
    }

}

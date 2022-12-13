<table class="table table-responsive table-striped table-bordered">
    <thead>
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requisition_items as $item)
        <tr>
            <td>{{$item->item_name}}</td>
            <td>{{$item->item_quantity}}</td>
            <td>{{$item->unit_cost}}</td>
            <td>{{$item->total_cost}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td><strong>Totals:</strong></td>
        <td>
            {{$requisition[0]->total}}
        </td>
    </tr>

    </tbody>

</table>


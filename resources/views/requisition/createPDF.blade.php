<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        table, th, td {
            border-collapse: collapse;
            border: 1px solid;
        }
        .department{
            display: flex;
            justify-content: center;
        }

    </style>
</head>
<body>
<div id="app" class="bg-white">
    <div class="align-content-center">
        <img src="{{public_path('pdf_logo.png')}}" class="rounded mx-auto d-block mt-2" alt="..." width="100" height="100">
        <h3 class="text-center mt-2">KOITALEL SAMOEI UNIVERSITY COLLEGE</h3>
        <h6 class="text-center mt-2">(A CONSTITUENT COLLEGE OF THE UNIVERSITY OF NAIROBI)</h6>

    </div>

    <hr class="mt-6 mb-2"/>

    <div class="d-flex justify-content-between department">
        <div>
            <strong>From: </strong>
            {{$requisition[0]->from_department}}
        </div>
        <div>
            <strong>To:</strong>
            {{$to_department[0]->to_department_name}}
        </div>
    </div>

    <p><strong>RE:</strong> <u>{{$requisition[0]->title}}</u></p>

    <p>{{$requisition[0]->description}}</p>


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
<br/>
<br/>
<br/>
    <div class="mt-5">
        <u>{{Auth::user()->name}}</u>
        <br/>
        <strong>{{$requisition[0]->from_department}} </strong>
    </div>
</div>
</body>
</html>

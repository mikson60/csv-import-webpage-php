@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Order {{$id}}</h2> 
                        <hr>
                        @if (!App\Order::IsValid($order->id))
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Invalid Order Row Data</h4>
                                <p>Current order has some invalid data. Invalid rows are marked as red in the table below.</p>
                                <hr>
                                <p class="mb-0">To edit a row, click the "Edit" button to the right of each individual row.</p>
                            </div>
                        @endif
                        <a class="btn btn-primary" href="/orders" role="button">Back</a>
                    </div>

                    <br />
                    
                    <div class="panel-body">
                        <div class="table-responsive-lg table-wrapper-2">
                                <table class="table table-bordered table-sm" data-toggle="table" data-pagination="true"
                                data-show-export="true">
                                    <caption>Order details</caption>
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" data-editable="true"> Name</th>
                                            <th scope="col"> Quantity</th>
                                            <th scope="col"> Thickness</th>
                                            <th scope="col"> Material</th>
                                            <th scope="col"> Bending</th>
                                            <th scope="col"> Threading</th>
                                            <th scope="col"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderDetails as $od)
                                            <a href="#">
                                                <tr class="table-{{$od->IsValid() ? 'default' : 'danger'}}" scope="row">
                                                    <td> {{$od->Name}}</td>
                                                    <td> {{$od->Quantity}}</td>
                                                    <td> {{$od->Thickness}}</td>
                                                    <td> {{$od->Material}}</td>
                                                    <td> {{$od->Bending == 0 ? 'No' : 'Yes' }}</td>
                                                    <td> {{$od->Threading == 0 ? 'No' : 'Yes' }}</td>
                                                <td> <a href="/orders/detail/{{$od->id}}">Edit</a></td>
                                                </tr>
                                            </a>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <a class="btn btn-primary" href="/orders" role="button">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


    
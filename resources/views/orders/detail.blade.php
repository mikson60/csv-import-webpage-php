@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Order {{$orderId}}</h2>
                        <hr>
                    </div>

                    <div class="panel-body">
                        {!! Form::model($orderDetail, ['action' => 'OrderDetailController@UpdateOrderDetail', 'class' => 'form']) !!}

                        <fieldset>

                        <div class="form-group row">
                            {{ Form::label('Name', 'Name', ['class' => 'col-sm-2 col-form-label']) }}
                            <div class="col-sm-4">
                                {{ Form::text('Name', $orderDetail->Name,['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('Quantity', 'Quantity', ['class' => 'col-sm-2 col-form-label']) }}
                            <div class="col-sm-4">
                                {{ Form::number('Quantity', $orderDetail->Quantity,['class' => 'form-control', 'min' => '1']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('Thickness', 'Thickness', ['class' => 'col-sm-2 col-form-label']) }}
                            <div class="col-sm-4">
                                {{ Form::number('Thickness', $orderDetail->Thickness,['class' => 'form-control', 'min' => '0.01', 'step' => '0.01']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('Material', 'Material', ['class' => 'col-sm-2 col-form-label']) }}
                            <div class="col-sm-4">
                                {{ Form::text('Material', $orderDetail->Material,['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="checkbox">
                                    {{ Form::label('Bending', 'Bending') }}
                                    {{ Form::checkbox('Bending') }}

                                    {{ Form::label('Threading', 'Threading') }}
                                    {{ Form::checkbox('Threading') }}
                                </div>
                            </div>
                        </div>
                        
                        {{ Form::text('id', $orderDetail->id,['class' => 'sr-only', 'readonly']) }}
                        {{ Form::text('OrderID', $orderDetail->OrderID,['class' => 'sr-only', 'readonly']) }}

                        {{ Form::submit('Update Order Detail', ['class' => 'btn btn-lg btn-info pull-right']) }}

                        </fieldset>

                        {!! Form::close() !!}
                    </div>

                    <br />

                    <div class="panel-footer">
                    <a class="btn btn-primary" href="/orders/{{$orderId}}" role="button">Back</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
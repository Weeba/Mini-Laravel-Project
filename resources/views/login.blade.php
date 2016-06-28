@extends('layout')

@section('content')
    <div class="container-fluid col-md-7">
        <h1>HI HELLO THERE</h1>
    </div>
    <div class="container-fluid col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Sign In</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'user.index']) !!}
                <div class="form-group">
                         <label>Email:</label>
                        {!! Form::email('email',  null, ['class' => 'form->control'], ['placeholder' => 'Email']) !!}
                </div>
                
                <div class="form-group">
                    <label>Password:</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                 <div class="form-group pull-right">
                    {!! Form::submit('Login', ['class' => 'btn btn-primary ']) !!} 
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Sign up</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'user.store']) !!}
                <div class="form-group">
                         <label>Name:</label>
                        {!! Form::text('name',  null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                         <label>Email:</label>
                        {!! Form::email('email',  null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    <label>Password:</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group pull-right">
                    {!! Form::submit('signup', ['class' => 'btn btn-primary ']) !!} 
                </div>
                
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
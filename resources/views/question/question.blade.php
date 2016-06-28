@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
             {!! Form::open(['route' => 'question.store']) !!}
            <div class="form-group">
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <!-- {!! Form::select('size', array('Large', 'Small'), ['class'=> 'form-control']) !!} -->
                {{ Form::select('category_id', array(1 => 'category 1', 2 => 'category 2', 3=>'category 3'),array('class'=>'form-control' )) }}
                    
            </div>

            
            <div class="form-group pull-right">
                {!! Form::submit('ask', ['class' => 'btn btn-primary ']) !!} 
            </div>
                      

            {!! Form::close() !!}
            <div class="col-md-5">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
        </div>
    </div>

</div>
@endsection

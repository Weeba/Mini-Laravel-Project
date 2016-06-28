@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
          
            @foreach($users as $user)
          
            <div class="col-md-10">
                <img width="150" height="150" class="center-block" src="{!! URL::asset($file) !!}">
                <p style="text-align: center">{!! $user->name !!}</p>
                </div>
                
                @if($user->id == Auth::user()->id)
                    {!! Form::open(array('route' => array('user.update', Auth::user()->id), 'method' => 'PATCH', 'files' => 'true')) !!}
                       
                        <div class="form-group">
                       
                        {!! Form::file('upload')!!}
                        {!! Form::button('<i class="glyphicon glyphicon-upload"></i>', ['class' => '', 'type' => 'submit']) !!} 
                       
                        </div>
                    {!! Form::close() !!}
                    <br/> 
                @endif

                @foreach($user->questions->reverse() as $question)
                
                <div class="container-fluid col-md-10" style="background-color: rgba(240,248,255,0.8); margin: 3px; padding: 20px; border-radius: 10px" >
                    <div class="container-fluid"> 
                        <div class="col-md-12">
                                <p style="float: left; font-weight: bold; font-size: 15px">{!! $question->body!!}&nbsp;&nbsp;&nbsp;</p>
                              
                                @if($user->id == Auth::user()->id)
                                    {!! Form::open(array('route' => array('question.destroy', $question->id), 'method' => 'delete')) !!}
                                       {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', ['class' => 'pull-right', 'type' => 'submit','style' => 'border:none; background-color:transparent;']) !!}
                                    {!! Form::close() !!}
                                @endif
                             
                                <p style="font-size: 10px; color:gray; margin-top: 5px;">{!! Carbon\Carbon::createFromTimeStamp(strtotime($question->created_at))->diffForHumans()!!}<p>
                        </div>

                        <div class="col-md-3">

                        no. of answers: {!! $question->answer !!}

                        </div>

                        @foreach($category as $categories)
                            @if($categories->id == $question->category_id)

                                <div class="col-md-2">
                                {!! $categories->description!!}
                                </div>
                            @endif
                        @endforeach
                        
                        <div class="container-fluid col-md-2">
                        <p>{!! $question->upvote!!} likes</p>

                        </div>

                        {!! Form::open(array('route' => array('question.show', $question->id))) !!}
                            {{ method_field('GET') }}
                            {!! csrf_field(); !!}
                                {!! Form::submit('View', ['class' => 'btn btn-primary pull-right']) !!} 
                        {!! Form::close() !!}
                        

                    </div>
                </div>

                @endforeach
            @endforeach
            
        </div>
    </div>
</div>
@endsection

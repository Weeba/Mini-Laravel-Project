@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="background-color: rgba(255, 170, 166, .7); border-radius: 10px;">

             @foreach($questions as $question)

                <div class="container-fluid"  style=" border-radius: 10px">

                        <div class="container-fluid col-md-12"> 

                            <h3 style="text-align: center">{!! $question->body!!} </h3>

                        </div>

                         <div class="container-fluid col-md-2" style="margin-top: 5%">

                            @if(Auth::user()->question_votes->where('question_id', $question->id)->where('user_id', Auth::user()->id)->count()==0)
                              
                                    <button class="like-button" value="{{ $question->id }}" id="like{{ $question->id }}" style="background-color: Transparent;border:none;"><span style="color:black" class="glyphicon glyphicon-heart" >{!! $question->upvote !!}</span></button>
                            
                            @else

                                @foreach(Auth::user()->question_votes as $vote)
                                    
                                    @if($vote->question_id==$question->id && $vote->status==1)

                                        <button class="like-button" value="{{ $question->id }}" id="like{{ $question->id }}" style="background-color: Transparent;border:none;"><span style="color:red" class="glyphicon glyphicon-heart" >{!! $question->upvote !!}</span></button>
                             
                                    @elseif($vote->question_id==$question->id && $vote->status==0)
                                      
                                        <button class="like-button" value="{{ $question->id }}" id="like{{ $question->id }}" style="background-color: Transparent;border:none;"><span style="color:black" class="glyphicon glyphicon-heart" >{!! $question->upvote !!}</span></button>
                                   
                                    @endif
                               
                                 @endforeach
                            @endif

                        </div>
                </div>

                <hr style="border-color: rgba(253, 210, 181, 1)"/>
                
                <div class="container-fluid">
                 {!! Form::open(['route' => 'answer.store']) !!}
                    <div>
                        {!! Form::hidden('question_id', $question->id) !!}

                        <div class="form-group" >
                            {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Answer here']) !!}
                        </div>

                    </div>

                    {!! Form::submit('answer', ['class' => 'btn btn-primary center-block', 'style' => 'background-color: rgba(255, 211, 133, 1)']) !!} 
                    {!! Form::close() !!}
                </div>

                <div class="col-md-5 col-md-offset-1">
                        
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
                <div class="col-md-10 col-md-offset-1">

                    @foreach($answers as $answer)

                        @foreach($users as $user)

                            @if($user->id == $answer->user_id)

                            <div class="col-md-12" style="background-color: rgba(240,248,255,0.9);margin: 5px;border-radius: 10px">

                                    <div class="container-fluid">

                                        <a href="{!! url('user/'.$user->id) !!}" style="text-decoration: none; float:left">
                                            <img  class="img-rounded" style="float:left"  width="50" height="50"  src="{!! URL::asset('/images/profile/'.$user->pictures['filename'].$user->pictures['extension']) !!}"></img>
                                        </a>
                                       
                                        <a href="{!! url('user/'.$user->id) !!}" style="text-decoration: none; float:left">
                                            {!! $user->name!!}
                                        </a>
                                       
                                        <p style="color:gray; font-size: 10px; margin-top: 3px" >
                                            &nbsp;&nbsp;&nbsp;{!! Carbon\Carbon::createFromTimeStamp(strtotime($answer->created_at))->diffForHumans()!!}
                                        </p>

                                         @if($user->id == Auth::user()->id)

                                            {!! Form::open(array('route' => array('answer.destroy', $answer->id), 'method' => 'delete')) !!}
                                               {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', ['class' => 'pull-right', 'type' => 'submit','style' => 'border:none; background-color:transparent;']) !!}
                                            
                                            {!! Form::close() !!}
                                        @endif
                                         <p>{!! $answer->body !!}</p>


                                    </div>

                                    <div class="container-fluid col-md-2">

                                    @if(Auth::user()->answer_votes->where('answer_id', $answer->id)->where('user_id', Auth::user()->id)->count()==0)
                                            <button class="like-button" value="{{ $answer->id }}" id="like{{ $answer->id }}" style="background-color: Transparent;border:none;"><span style="color:black" class="glyphicon glyphicon-heart" >{!! $answer->upvote !!}</span></button>
                                    @else

                                    @foreach(Auth::user()->answer_votes as $vote)

                                        @if($vote->answer_id==$answer->id && $vote->status==1)

                                            <button class="like-button" value="{{ $answer->id }}" id="like{{ $answer->id }}" style="background-color: Transparent;border:none;"><span style="color:red" class="glyphicon glyphicon-heart" >{!! $answer->upvote !!}</span></button>
                                      
                                        @elseif($vote->answer_id==$question->id && $vote->status==0)

                                            <button class="like-button" value="{{ $answer->id }}" id="like{{ $answer->id }}" style="background-color: Transparent;border:none;"><span style="color:black" class="glyphicon glyphicon-heart" >{!! $answer->upvote !!}</span></button>
                                   
                                        @endif

                                    @endforeach
                                   
                                    @endif

                                    </div>
                            </div>

                            @endif

                        @endforeach
                        
                    @endforeach  
                </div>  
            @endforeach
        </div>
    </div>

</div>
@endsection

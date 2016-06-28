@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3" style="background-color: rgba(240,248,255,0.8); margin-right: 0px;border-radius: 5px">
                <h3 style="text-align: center;">TRENDS</h3>
                <hr style="border-color: #FFD385;" />

                @foreach($trendings as $trending)

                    <a style="font:black;text-decoration: none;" href="question/{!! $trending->id !!}">{!! $trending->body !!}</a>
                    <p>{!! $trending->answer !!} replies</p>

                @endforeach
        </div>
        <div class="col-md-6" style="margin:0px; padding:0px 15px 0px 15px">

                @foreach($questions as $question)

                <div class="container-fluid" style="background-color:rgba(240,248,255,0.8);margin-bottom: 1px;border-radius: 5px"> 
                    <div class="col-md-12" style="padding:5px">
                            @foreach($users as $user)

                                @if($user->id == $question->user_id)   
                                        
                                        <a style="font-weight: bold; float:left;" href="{!! url('user/'.$user->id)!!}">
                                            <img  class="img-rounded" style="float:left"  width="50" height="50"  src="{!! URL::asset('/images/profile/'.$user->pictures['filename'].$user->pictures['extension']) !!}"></img>
                                        </a>
                                        <a style="font-weight: bold; float:left; text-decoration:none" href="{!! url('user/'.$user->id)!!}">
                                           &nbsp;&nbsp;&nbsp; {!! $user->name !!}
                                        </a>
                                        <p style="color:gray; font-size: 10px; margin-top: 4px; float:left">
                                            &nbsp;&nbsp;&nbsp;{!! Carbon\Carbon::createFromTimeStamp(strtotime($question->created_at))->diffForHumans()!!}
                                        </p>
                                        @if($user->id == Auth::user()->id)
                                            {!! Form::open(array('route' => array('question.destroy', $question->id), 'method' => 'delete')) !!}
                                               {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', ['class' => 'pull-right', 'type' => 'submit','style' => 'border:none; background-color:transparent;']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                @endif
                            @endforeach
                            <div class="col-md-10" style="margin-top:0px">
                            <p style="float:left">{!! $question->body!!}</p>
                            </div>

                            </div>
                            <div class="container-fluid col-md-2 col-md-offset-1">
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

                            @foreach($categories as $category)

                                @if($category->id == $question->category_id)

                                <div class="container-fluid col-md-3">
                                    <p style="float:left">{!! $category->description !!}</p>
                                </div>

                                @endif
                                
                            @endforeach

                            <div class="container-fluid col-md-2">
                                <a href="{!! url('question/'.$question->id) !!}" style="color:black;text-decoration: none; ">
                                <p style="float:left">{!! $question->answer !!} replies</p>
                                </a>
                            </div>

                    </div>  

            @endforeach
        </div>

        <div class="col-md-3" style="margin:0px; padding:0px">

            <div class="container-fluid" style="background-color: rgba(240,248,255,0.8); margin: 0px 0px 3px 0px; padding: 10px; border-radius: 5px">
                <a href="{!! url('home/1') !!}" class="btn btn-primary" style="width:100%; border:none; margin-bottom:5px;background: #FFD385;">Category 1</a>
                <a href="{!! url('home/2') !!}" class="btn btn-primary" style="width:100%; border:none; margin-bottom:5px; background: #FFAAA6;">Category 2</a>
                <a href="{!! url('home/3') !!}" class="btn btn-primary" style="width:100%; border:none; margin-bottom:5px; background: #FF8C94;">Category 3</a>
            </div>

            <div class="container-fluid" style="background-color: rgba(240,248,255,0.8); margin: 5px 0px 5px 0px; border-radius: 5px" >
                <p>
                    About Askhole Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Curabitur imperdiet neque nisi, at consectetur enim feugiat non. 
                    Aenean et accumsan neque. Aenean tempor scelerisque leo, nec bibendum elit posuere quis. Integer eu commodo mi. 
                </p>

                <hr style="border-color: #FFD385;"/>
                <p>This is brought to you by ..</p>
            </div> 
        <div>
    </div>
</div>

<div class="col-md-12">

    {!! $questions->links()!!}
    
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3" style="background-color: rgba(240,248,255,0.8); margin-right: 0px;border-radius: 5px">
                <h3 style="text-align: center;">TRENDS</h3>
                <hr style="border-color: #FFD385;" />

                @foreach($trending as $trendings)

                    <a style="font:black;text-decoration: none;" href="question/{!! $trendings->id !!}">{!! $trendings->body !!}</a>
                    <p>{!! $trendings->answer !!} replies</p>

                @endforeach
        </div>
        <div class="col-md-6" style="margin:0px; padding:0px 15px 0px 15px">

                @foreach($question as $questions)

                <div class="container-fluid" style="background-color:rgba(240,248,255,0.8);margin-bottom: 1px;border-radius: 5px" > 
                        <div class="container-fluid col-md-12"> 

                            @foreach($users as $user)

                                @if($user->id == $questions->user_id)   
                                        
                                        <a style="font-weight: bold; float:left; font-size: 15px" href="{!! url('user/'.$user->id)!!}">{!! $user->name !!} &nbsp;</a> 
                                        <a href="{!! url('question/'.$questions->id) !!}" style="color:black;text-decoration: none; ">
                                        <p style="float:left; color:gray; font-size: 10px; margin-top: 4px" >{!! $user->email !!} &nbsp; </p> 
                                @endif

                            @endforeach

                            <p style="color:gray; font-size: 10px; margin-top: 4px" >

                                {!! Carbon\Carbon::createFromTimeStamp(strtotime($questions->created_at))->diffForHumans()!!}

                            </p>
                        </div>
                        <div class="col-md-12">

                            <p>{!! $questions->body!!}</p>

                        </div>
                         <div class="container-fluid col-md-2" >


                        <p style="color:gray" id="vote{{ $questions->id }}">&nbsp;&nbsp;&nbsp;{!! $questions->upvote !!}</p>

                        </div>

                          @foreach($category as $categories)
                                @if($categories->id == $questions->category_id)
                                <div class="container-fluid col-md-3">
                                    <p style="float:left">{!! $categories->description !!}</p>
                                </div>
                                @endif
                        @endforeach

                            <div class="container-fluid col-md-2">
                                <p style="float:left">{!! $questions->answer !!} replies</p>
                            </div>
                    </div>  
                 </a>
                        <button class="like-button" value="{{ $questions->id }}" id="like{{ $questions->id }}"></button>

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

    {!! $question->links()!!}
    
</div>
@endsection


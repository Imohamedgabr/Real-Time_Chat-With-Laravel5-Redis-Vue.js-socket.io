@extends('layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">
   
   
   
@if(count($users) > 0)
	<div class="panel panel-default">
            <table class="table">
            @foreach($users as $user )
              <tr>
                <td class="middle">
                  <div class="media">
                    <div class="media-left">
                       <h4 class="media-heading">{{$user->name}} </h4> </a>
                      <b>
                        {{$user->email}}
                      </b>
                      
                      <a href="{{ route('conversation',['user_id'=> $user->id]) }}"><button class="btn btn-success">Message this user</button></a>
                    </div>
                  </div>
              
              
              </tr>
            @endforeach  
            </table>            
          </div>

  @else

  <h3>No Users found Please make sure name is correct</h3>
          
  @endif
    </div>
  </div>
</div>
    
@endsection

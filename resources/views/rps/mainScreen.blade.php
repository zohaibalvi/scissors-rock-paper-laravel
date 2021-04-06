@extends('layouts.app')

@section('content')
 <div class="container">
 <ul style="float: right;list-style-type: none;" class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}/ </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
      <div align="center">
        <img src="{{ asset('uploads/rps.png') }}" id="logo" />
       
      
      </div>

      <h2 id="title">Rock Paper Scissors</h2>
      <div class="row">
        <div class="col-md-4">
          <h5 align="center" id="player_counter"></h5>
        </div>
        <div class="col-md-4">
          <h4 align="center" id="choices"></h4>
          <h4 align="center" id="points"></h4>
        </div>
        <div class="col-md-4">
          <h5 align="center" id="computer_counter"></h5>
        </div>
      </div>

      <div align="center">
        <form name="input" id="form" action="{{ route('home.rps') }}" method="post">
        @csrf
          <div class="boxed">
            <input
              class="submitOnclick"
              type="radio"
              id="rock"
              name="choice"
              value="rock"
            />
            <label for="rock">
              <img style="height: 70px" src="{{ asset('uploads/rock.png') }}" />
            </label>

            <input
              class="submitOnclick"
              type="radio"
              id="paper"
              name="choice"
              value="paper"
            />
            <label for="paper">
              <img style="height: 70px" src=" {{ asset('uploads/paper.png') }}" />
            </label>

            <input
              class="submitOnclick"
              type="radio"
              id="scissors"
              name="choice"
              value="scissors"
            />
            <label for="scissors">
              <img style="height: 70px" src=" {{ asset('uploads/scissor.png') }}" />
            </label>
          </div>
        </form>
      </div>
    </div>
    <script>
      $(document).ready(function () {
        var player_count = computer_count = 0;
        // $("body").addClass("bg1");
        $(".submitOnclick").click(function (e) {
          e.preventDefault(); 
          var form = $("#form");
          var url = form.attr("action");

          $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function (data) {
                // console.log(data)
              var result = JSON.parse(data);
              if (result.status == 0) {
                player_count += 0;
                computer_count += 0;
                $("#points").html("Tie");
              } else if (result.status == -1) {
                player_count += 1;
                $("#points").html(result.user_name+" got 1 point");
              } else {
                computer_count += 1;
                $("#points").html("Computer player got 1 point");
              }
          
              $("#player_counter").html(result.user_name+" Counter: " + player_count);
              $("#computer_counter").html(
                "Computer Counter: " + computer_count
              );
              $("#choices").html(
                result.player_choice + " vs. " + result.computer_choice
              );
              data = {computer_count:computer_count,player_count:player_count}
              if (player_count == 10) {
                  
                savePointRecords(data);
                player_count = computer_count = 0;
                $("#player_counter").html(result.user_name+" Counter: " + 0);
                $("#computer_counter").html("Computer Counter: " + 0);
              } else if (computer_count == 10) {
                savePointRecords(data);
                player_count = computer_count = 0;
                // alert("Computer 1 Wins");
                // console.log(result.user_name)
                $("#player_counter").html(result.user_name+" Counter: " + 0);
                $("#computer_counter").html("Computer Counter: " + 0);
              }
            },
          })
        });

        function savePointRecords(data){
            $.ajax({
            type: "POST",
            url: "{{ route('home.savePoints') }}",
            data: { _token: '{{csrf_token()}}',data:data}, 
                success: function (data) {
                    $("body").addClass("bg1");

                }
            });
        }
      });
    </script>
   @endsection
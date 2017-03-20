@extends('auth.layouts.auth')

@section('content')

<login inline-template v-cloak>
  <div class="wrap" style="height: 100%">
    <div class="login-page">
        <div class="container flex-centered-both flex-column flex-1" style="width: 15%; min-width: 200px; display: none" v-show="showLogin" key="1">
          <h1 class="title is-1 text-white has-text-centered">
            <strong>The Quiz</strong>
          </h1>
          <form class="form" role="form" method="POST" action="{{ route('login') }}" style="background-color: #111; padding: 20px; opacity: 0.85; border-radius: 5px; width: 100%">
             {{ csrf_field() }}

             <div class="field">
               <label class="label text-white">Login</label>
               <p class="control">
                 <input name="login" class="input{{ $errors->has('login') ? ' is-danger' : '' }}" type="text" placeholder="Login" required>
               </p>
               @if($errors->has('login'))
               <p class="help is-danger">{{$errors->first('login')}}</p>
               @endif
             </div>

             <div class="field">
               <label class="label text-white">Password</label>
               <p class="control">
                 <input name="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" type="password" placeholder="Password" required>
               </p>
               @if($errors->has('password'))
               <p class="help is-danger">{{$errors->first('password')}}</p>
               @endif
             </div>

             <div class="field" style="margin-top: 10px">
               <p class="control has-text-centered">
                 <button type="submit" class="button is-primary is-outlined" style="width: 100%">
                     Log in
                 </button>
               </p>
             </div>
         </form>
         <p class="control has-text centered" style="margin-top: 10px" @click="showLogin = false">
           <a>Go back</a>
         </p>
        </div>
        <div class="container has-text-centered flex-centered-both flex-column flex-1" v-if="!showLogin && !showRegister" key="2">
          <h1 class="title is-1 text-white">
            <strong>Do you know the answers?</strong>
          </h1>
          <h2 class="title" style="color: white">
            <strong>Join The Quiz and find out!</strong>
          </h2>

          <div class="buttons">
            <button class="button is-large is-primary">
              Join now
            </button>
            <button class="button is-large is-primary is-inverted is-outlined" @click="showLogin = true">
              Log in
            </button>
          </div>
        </div>
      <div class="has-text-centered text-white flex-centered-both flex-column" @click="scrollDown()">
        Learn more
        <div class="learn-more-arrow">
          ↓
        </div>
      </div>
    </div>
    <div class="container" style="padding-top: 50px" id="content">
      <h1 :class="['title', 'is-1', 'has-text-centered', 'hidden-init', {'visible': level > -1}]" id="0">
        <strong>How does it work?</strong>
      </h1>

      <div :class="['columns', 'hidden-init', {'visible': level > 0}]" style="padding-top: 50px" id="1">
        <div class="column flex-centered-both flex-column">
          <img src="/img/rocket.png" alt="Rocket" class="main-image">
        </div>
        <div class="column flex-centered-both flex-column">
          <h1 class="title is-2">
            Sign up and start completing quizzes.
          </h1>
          <h1 class="subtitle">
            Everyone in the community is free to create a quizs, so you won't be bored!
          </h1>
        </div>
      </div>

      <div :class="['columns', 'hidden-init', {'visible': level > 1}]" style="padding-top: 50px" id="2">
        <div class="column flex-centered-both flex-column is-hidden-tablet">
          <img src="/img/network.png" alt="Rocket" class="main-image">
        </div>
        <div class="column flex-centered-both flex-column">
          <h1 class="title is-2">
            Create and share your own quizzes.
          </h1>
          <h1 class="subtitle">
            Have an idea? Get people interested, and your quiz certainly won't go unnoticed!
          </h1>
        </div>
        <div class="column flex-centered-both flex-column is-hidden-mobile">
          <img src="/img/network.png" alt="Rocket" class="main-image">
        </div>
      </div>

      <div :class="['columns', 'hidden-init', {'visible': level > 2}]" style="padding-top: 50px" id="3">
        <div class="column flex-centered-both flex-column">
          <img src="/img/trophy.png" alt="Rocket" class="main-image">
        </div>
        <div class="column flex-centered-both flex-column">
          <h1 class="title is-2">
            Earn points and become the quiz master!
          </h1>
          <h1 class="subtitle">
            You get points for each unique quiz you complete. You also get double points when your quiz is completed by someone else!
          </h1>
        </div>
      </div>
    </div>
    <!--<div class="hero is-medium is-info" style="margin-top: 50px;">
      <div class="container" style="width: 100%">
        <div class="hero-body">
          <div class="columns is-12 has-text-centered">

            <div class="column">
              <h1 class="title">
                48 <br>
                Quizzes
              </h1>
            </div>

            <div class="column">
              <h1 class="title">
                48 <br>
                Users
              </h1>
            </div>

            <div class="column">
              <h1 class="title">
                48 <br>
                Questions
              </h1>
            </div>

            <div class="column">
              <h1 class="title">
                48 <br>
                Completed quizzes
              </h1>
            </div>

          </div>
        </div>
      </div>
    </div>-->
    <div class="footer" style="background-color: #111; margin-top: 50px">
      <div class="container">
        <div class="columns">
          <div class="column has-text-centered">
            <p><strong>The Quiz</strong> by <a href="mailto:kontakt@tomaszrup.pl">Tomasz Rup</a></p>
            <p>Tomasz Rup {{Date('Y')}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</login>
@endsection

<template>
  <div class="wrap" style="height: 100%">
    <div class="login-page">


        <div class="container flex-centered-both flex-column flex-1 login-form-container" style="display: none" v-show="showLogin" key="1">
          <h1 class="title is-1 text-white has-text-centered">
            <strong>The Quiz</strong>
          </h1>

          <form class="form login-form" @submit.prevent="login()">
             <div class="field">
               <label class="label text-white">Login</label>
               <p class="control">
                 <input name="login" :class="['input', {'is-danger': loginForm.error}]" type="text" v-model="loginForm.login" placeholder="Login" required>
               </p>
             </div>

             <div class="field">
               <label class="label text-white">Password</label>
               <p class="control">
                 <input name="password" :class="['input', {'is-danger': loginForm.error}]" type="password" v-model="loginForm.password" placeholder="Password" required>
               </p>
               <p class="help is-danger" v-if="loginForm.error">{{loginForm.error}}</p>
             </div>

             <div class="field" style="padding-top: 10px">
               <p class="control">
                 <label class="label text-white"><input type="checkbox" v-model="loginForm.remember" name="remember" class="checkbox" value="remember"> Remember me </label>
               </p>
             </div>

             <div class="field" style="margin-top: 10px">
               <p class="control has-text-centered">
                 <button type="submit" :class="['button', 'is-primary', {'is-loading': submitting}]" style="width: 100%">
                     Log in
                 </button>
               </p>
             </div>
         </form>
         <p class="control has-text centered" style="margin-top: 10px" @click="showLogin = false">
           <a>Go back</a>
         </p>
        </div>


        <div class="container flex-centered-both flex-column flex-1 login-form-container" style="display: none" v-show="showRegister" key="2">
          <h1 class="title is-1 text-white has-text-centered">
            <strong>The Quiz</strong>
          </h1>

          <form class="form login-form" role="form" method="POST" action="">

            <div class="field">
              <label class="label text-white">Name</label>
              <p class="control">
                <input name="name" class="input" type="text" placeholder="Name" required v-model="registerForm.name">
              </p>
            </div>

             <div class="field">
               <label class="label text-white">Login</label>
               <p class="control">
                 <input name="login" class="input" type="text" placeholder="Login" required @change="checkAvailability()" @keyup="registerForm.availability.message = ''" v-model="registerForm.login">
               </p>
               <p :class="['help', {'is-danger': !registerForm.availability.okay, 'is-success': registerForm.availability.okay}]" v-if="registerForm.availability.message">{{registerForm.availability.message}}</p>
             </div>

             <div class="field">
               <label class="label text-white">Password</label>
               <p class="control">
                 <input name="password" class="input" type="password" placeholder="Password" required>
               </p>
             </div>

             <div class="field">
               <label class="label text-white">Confirm password</label>
               <p class="control">
                 <input name="password_confirmation" class="input" type="password" placeholder="Password" required>
               </p>
             </div>

             <div class="field" style="margin-top: 10px">
               <p class="control has-text-centered">
                 <button type="submit" class="button is-primaryisa" style="width: 100%">
                     Register
                 </button>
               </p>
             </div>
         </form>
         <p class="control has-text centered" style="margin-top: 10px" @click="showRegister = false">
           <a>Go back</a>
         </p>
        </div>


        <div class="container has-text-centered flex-centered-both flex-column flex-1" v-if="!showLogin && !showRegister" key="3">
          <h1 class="title is-1 text-white">
            <strong>Do you know the answers?</strong>
          </h1>
          <h2 class="title" style="color: white">
            <strong>Join The Quiz and find out!</strong>
          </h2>

          <div class="buttons">
            <button class="button is-large is-primary" @click="showRegister = true">
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
            Everyone in the community is free to create a quiz, so you won't be bored!
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
            <p>Tomasz Rup {{now()}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    window.addEventListener('scroll', this.scrollHandler);
  },
  data() {
    return {
      showLogin: false,
      showRegister: false,
      submitting: false,
      loginForm: {
        login: '',
        password: '',
        error: '',
        remember: false
      },
      registerForm: {
        login: '',
        password: '',
        passwordConfirmation: '',
        name: '',
        availability: {
          okay: null,
          message: ''
        }
      },
      level: -1
    }
  },
  methods: {
    checkAvailability() {
      axios.post('/api/register/availability', {
        login: this.registerForm.login
      }).then((response) => {
        this.registerForm.availability.message = response.data.data;
        this.registerForm.availability.okay = true;
      }).catch((error) => {
        this.registerForm.availability.message = error.response.data;
        this.registerForm.availability.okay = false;
      });
    },
    scrollHandler() {
      for (var i = 0; i < document.getElementById('content').childElementCount; i++) {
        var el = document.getElementById(i);
        if(el.getBoundingClientRect().top < window.innerHeight - 200) {
          if(this.level < i) this.level = i;
        }
      }
    },
    scrollDown() {
      this.$SmoothScroll(document.getElementById('content'), 1000);
    },
    login() {
      this.submitting = true;

      axios.post('/api/login', {
        login: this.loginForm.login,
        password: this.loginForm.password,
        remember: this.loginForm.remember,
      }).then((response) => {
        location.reload();
      }).catch((error) => {
        console.log('abc');
        this.loginForm.error = error.response.data;
        this.submitting = false;
      });
    },
    now() {
      let date = new Date;
      return date.getFullYear();
    }
  }
}
</script>

<style lang="css">
</style>

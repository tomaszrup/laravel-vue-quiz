<template lang="html">
  <div class="container" style="width: 100%">
    <nav class="nav">
      <div class="nav-left">
        <router-link to="/" class="nav-item">
          <h1 class="title">Quiz</h1>
        </router-link>
      </div>

      <span class="nav-toggle" @click="menuOpen = !menuOpen">
        <span></span>
        <span></span>
        <span></span>
      </span>

      <div :class="['nav-right', 'nav-menu', {'is-active': menuOpen}]">
        <router-link to="/" class="nav-item is-tab" exact>
          Home
        </router-link>
        <span class="nav-item">
          <router-link to="/add" class="button is-primary" exact>
            <span>Add a quiz</span>
          </router-link>
        </span>
        <span class="nav-item">
          <button class="button" @click="logout()">
            <span>Logout</span>
          </button>
        </span>

        <form action="/logout" method="post" class="hidden" id="logout">
          <input type="text" name="_token" :value="token">
        </form>

      </div>
    </nav>
  </div>
</template>
<script>
export default {
  data() {
    return {
      menuOpen: false
      //currentQuiz: false
    }
  },
  created() {
    /**bus.$on('quiz:entered', (quizId) => {
      this.currentQuiz = quizId;
    });
    bus.$on('quiz:completed', () => {
      this.currentQuiz = false;
    });**/
  },
  methods: {
    logout() {
      document.getElementById('logout').submit();
    }
  },
  computed: {
    token() {
      return Laravel.csrfToken;
    }
  }
}
</script>
<style lang="scss">
  .hidden {
    display: none;
  }
</style>

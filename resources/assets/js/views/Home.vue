<template>
  <div class="wrap">
    <section class="hero is-medium is-primary is-bold">
      <div class="hero-body">
        <div class="container">
          <h1 class="title is-medium has-text-centered">
            Hello there, want to answer some questions?
          </h1>
        </div>
      </div>
    </section>
    <section class="container" style="padding-top: 40px; padding-bottom: 40px;">
      <div class="columns">
        <div class="column is-6">
          <h1 class="title">
            Latest quizzes
          </h1>
          <quizzes :amount="5"></quizzes>
        </div>

        <div class="column is-6">
          <h1 class="title">
            Most completed
          </h1>
          <quizzes :amount="5" sort-by="completions" sort-dir="desc"></quizzes>
        </div>
      </div>

      <div>
        <h1 class="title">
          All quizzes
        </h1>
        <quizzes sort-by="title" sort-dir="asc"></quizzes>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  created() {
    bus.$on('quiz:added', () => {
      bus.$emit('quizzes:refresh');
    });
    bus.$on('quiz:completed', () => {
      bus.$emit('quizzes:refresh');
    });
  }
}
</script>

<style lang="scss">
  .container {
    padding: 10px;
  }
</style>

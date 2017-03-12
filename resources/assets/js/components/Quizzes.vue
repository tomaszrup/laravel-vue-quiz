<template>
  <div class="quizzes">
    <staggered-fade>
      <div class="quiz box is-6" v-for="quiz, index in quizzes" :key="index" :data-index="index">
        <h2 class="title">
          {{quiz.title}}
          <span class="tag is-dark">
            {{quiz.completions}}
          </span>
        </h2>
        <p>
          {{quiz.author}} {{fromNow(quiz.created_at)}}
        </p>
      </div>
    </staggered-fade>
  </div>
</template>

<script>
export default {
  data() {
    return {
      quizzes: []
    }
  },
  created() {
    axios.get('/api/quizzes').then((response) => {
      this.quizzes = response.data.data;
    })
  },
  methods: {
    fromNow(date) {
      console.log(date);
      return moment(date.date).fromNow();
    }
  }
}
</script>

<style lang="scss">
.quiz {
  cursor: pointer;
}
</style>

<template>
  <div class="quizzes">
    <staggered-fade v-if="quizzes[0]">
      <router-link class="quiz box" style="color: #333" v-for="quiz, index in quizzes" :to="'/quiz/'+quiz.id" :key="index" :data-index="index">
        <h2 class="title">
          {{quiz.title}}
          <span class="tag is-dark">
            {{quiz.completions}} completions
          </span>
        </h2>
        <p>
          {{quiz.author}}, {{fromNow(quiz.created_at)}}
        </p>
      </router-link>
    </staggered-fade>
    <loader v-else></loader>
  </div>
</template>

<script>
export default {
  props: ['amount', 'sortBy', 'sortDir'],
  data() {
    return {
      quizzes: []
    }
  },
  created() {
    this.callApi();
    bus.$on('quiz:added', this.callApi);
  },
  methods: {
    fromNow(date) {
      return moment(date.date).fromNow();
    },
    callApi() {
      axios.get('/api/quizzes', {
        params: {
          amount: this.amount,
          sortby: this.sortBy,
          sortdir: this.sortDir
        }
      }).then((response) => {
        this.quizzes = response.data.data;
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.quiz {
  cursor: pointer;
}
</style>

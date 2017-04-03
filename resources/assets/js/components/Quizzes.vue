<template>
  <div class="quizzes">
    <staggered-fade v-if="!loading && !error">
      <router-link class="quiz box" style="color: #333" v-for="quiz, index in quizzes" :to="'/quiz/'+quiz.id" :key="index" :data-index="index">
        <h2 class="title">
          {{quiz.title}} <br>
          <span class="tag is-dark">
            {{quiz.completions}} completions
          </span>
          <span class="tag is-success" v-if="quiz.completed">
            ✓
          </span>
          <span class="tag is-success" v-if="quiz.author.id == $root.user.id">
            created by You
          </span>
        </h2>
        <p>
        </p>
        <p>
          {{quiz.author.name}}, {{fromNow(quiz.created_at)}}
        </p>
      </router-link>
    </staggered-fade>
    <div class="box" v-else-if="!loading && error">
      {{error}}
    </div>
    <loader v-else></loader>
  </div>
</template>

<script>
export default {
  props: ['amount', 'sortBy', 'sortDir'],
  data() {
    return {
      quizzes: [],
      error: '',
      loading: false
    }
  },
  created() {
    this.callApi();
    bus.$on('quizzes:refresh', this.callApi);
  },
  methods: {
    fromNow(date) {
      return moment(date.date).fromNow();
    },
    callApi() {
      this.error = false;
      this.loading = true;

      axios.get('/api/quizzes', {
        params: {
          amount: this.amount,
          sortby: this.sortBy,
          sortdir: this.sortDir
        }
      }).then((response) => {
        this.loading = false;
        this.quizzes = response.data.data[0] ? response.data.data : [{title: 'There are no quizes yet :('}];
      }).catch((error) => {
        this.loading = false;
        this.error = error.response.data;
      });
    }
  }
}
</script>

<style lang="scss" scoped>
.quiz {
  cursor: pointer;
}
</style>

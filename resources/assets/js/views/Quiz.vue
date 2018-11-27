<template>
  <div class="wrap" style="height: 100%">
    <section class="hero is-info" v-if="quiz.title && questions[0]">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            {{quiz.title}} by {{quiz.author.name}}
          </h1>
          <h1 class="subtitle is-small">
            <span class="tag is-warning" v-if="quiz.completed">
              You have already completed this quiz.
            </span>
            <span class="tag is-warning" v-else-if="quiz.author.id == $root.user.id">
              You are the author of this quiz.
            </span>
          </h1>
        </div>
      </div>
    </section>
    <div class="quiz-questions" v-if="questions[0] && !finished">
      <div class="container">
        <div class="box" v-for="question, index in questions">
          <div class="question-helper">
            Question #{{index + 1}}
          </div>
          <div class="question-body">
            {{question.body}}
          </div>
          <div class="columns">
            <div class="column" v-for="letter in ['a', 'b', 'c', 'd']">
              <span :class="['answer-icon', {'is-selected': answers[question.id] == letter}]" @click="setAnswer(question.id, letter)">{{uppercase(letter)}}</span>
              {{question.answers[letter]}}
            </div>
          </div>
        </div>

        <div class="has-text-centered" style="margin-top: 15px">
          <button :class="['button', 'is-primary', 'is-large', {'is-loading': submitting}]" @click="complete()">
            Complete
          </button>
        </div>
      </div>
    </div>
    <div class="container" style="display: flex; height: 100%; width: 100%; justify-content: center; align-items: center" v-else-if="!finished">
      <loader></loader>
    </div>
    <div class="container" v-else>
      <h1 class="title" style="margin-top: 30px">
        Your score: {{score}}/{{questions.length}}
      </h1>
      <progress class="progress is-primary" :value="score" :max="questions.length"></progress>
    </div>
  </div>
</template>

<script>
export default {
  name: 'quiz',
  data() {
    return {
      questions: [],
      quiz: [],
      answers: [],
      submitting: false,
      finished: false,
      score: 0
    }
  },
  beforeRouteLeave (to, from, next) {
    if(this.finished) return next();
    else if(confirm('Are you sure you want to leave? Your progress will not be saved.')) return next();
    return next(false);
  },
  created() {
    bus.$emit('quiz:entered', this.quizId);
    this.callApi();
  },
  methods: {
    callApi() {
      axios.get('/api/quizzes/'+this.quizId).then((response) => {
        this.quiz = response.data.data;
      });

      axios.get('/api/quizzes/'+this.quizId+'/questions').then((response) => {
        this.questions = response.data.data;
      });
    },
    uppercase(letter) {
      return _.upperCase(letter);
    },
    setAnswer(id, letter) {
      this.answers[id] = letter;
      this.answers.push();
    },
    complete() {
      this.submitting = true;

      axios.post('/api/quizzes/'+this.quizId+'/complete', {
        answers: this.answers
      }).then((response) => {
        this.submitting = false;
        this.finished = true;
        this.score = response.data.data;
        bus.$emit('quiz:completed');
      });
    }
  },
  computed: {
    quizId() {
      return this.$route.params.quiz;
    }
  }
}
</script>

<style lang="scss">
.question-helper {
  padding: 5px;
  color: #aaa;
}
.question-body {
  padding: 0px 0px 10px;
}
.answer-icon {
  width: 100%;
  display: block;
  text-align: center;
  padding: 3px;
  border: 1px dashed #aaa;
  margin-bottom: 5px;
  cursor: pointer;
  &.is-selected {
    background-color: orangered;
    border: 1px solid orangered;
    color: white;
  }
}
</style>

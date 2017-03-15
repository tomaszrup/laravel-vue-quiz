<template>
  <div class="wrap" v-if="quiz.title && questions[0]">
    <section class="hero is-info">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            {{quiz.title}} by {{quiz.author}}
          </h1>
        </div>
      </div>
    </section>
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
  <div class="container" v-else>
    <loader></loader>
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
      submitting: false
    }
  },
  created() {
    this.callApi();
  },
  methods: {
    callApi() {
      axios.get('/api/quizzes/'+this.quizNumber).then((response) => {
        this.quiz = response.data.data;
      });

      axios.get('/api/quizzes/'+this.quizNumber+'/questions').then((response) => {
        this.questions = response.data.data;
      });
    },
    uppercase(letter) {
      return _.upperCase(letter);
    },
    setAnswer(id, letter) {
      console.log('>>');
      this.answers[id] = letter;
      this.answers.push();
    },
    complete() {

    }
  },
  computed: {
    quizNumber() {
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

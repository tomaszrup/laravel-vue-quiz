<template>
  <div class="wrap">
    <section class="hero is-info">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Add a quiz
          </h1>
        </div>
      </div>
    </section>

    <div class="container">
      <div class="columns">
        <div class="column is-7">
          <input type="text" v-model="title" class="quiz-title" placeholder="Your quiz title here">
        </div>
      </div>

      <div class="box" v-for="question, index in questions">
        <div class="columns">
          <div class="column is-12">
            <div class="question-helper" style="display: flex; flex-direction: column">
              <button class="button is-danger" style="align-self: flex-end" @click="deleteQuestion(index)">X</button>
              Question #{{index+1}}
            </div>
            <textarea v-model="question.body"></textarea>
            <div class="question-helper">
              Answers (click the heading to mark as correct)
            </div>
            <div class="columns">
              <div class="column" v-for="letter in ['a', 'b', 'c', 'd']">
                <span :class="['answer-icon', {'is-correct': question.correct_answer == letter}]" @click="question.correct_answer = letter">{{uppercase(letter)}}</span>
                <textarea v-model="question[letter]"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="question-add has-text-centered">
        <button class="button is-info" @click="addQuestion()">
          Add a question
        </button>
      </div>

      <div class="question-add has-text-centered" style="margin-top: 15px">
        <button :class="['button', 'is-primary', 'is-large', {'is-disabled': emptyValues}, {'is-loading': submitting}]" @click="submit()">
          Submit
        </button>
      </div>

    </div>
  </div>
</template>

<script>

String.prototype.isEmpty = function() {
    return (this.length === 0 || !this.trim());
};

class Question {
  constructor() {
    this.body = '';
    this.a = '';
    this.b = '';
    this.c = '';
    this.d = '';
    this.correct_answer = '';
  }
}

export default {
  data() {
    return {
      title: '',
      author: '',
      questions: [],
      submitting: false,
      indexes: 0
    }
  },
  created() {
    this.addQuestion();
  },
  methods: {
    uppercase(letter) {
      return _.upperCase(letter);
    },
    deleteQuestion(index) {
      if (this.questions.length <= 1) return;

      this.questions.splice(index, 1);
    },
    addQuestion() {
      this.questions.push(new Question);
    },
    submit() {
      if(!confirm('Are you sure?')) return;

      this.submitting = true;

      axios.post('/api/quizzes', {
        title: this.title,
        author: this.author,
        questions: this.questions
      }).then((response) => {
        bus.$emit('quiz:added', response.data);
        this.questions = [new Question];
        this.submitting = false;
        this.$router.push('/');
        this.title = '';
        this.author = '';
      }).catch((error) => {
        console.log(error);
      });
    }
  },
  computed: {
    emptyValues() {
      var hasEmptyValue = false;

      this.questions.forEach((question) => {
        for (var property in question) {
          if (question.hasOwnProperty(property)) {
              if(question[property].isEmpty()) {
                hasEmptyValue = true;
                return;
              }
          }
        }
      });

      return hasEmptyValue || this.title.isEmpty();
    }
  }
}
</script>

<style lang="scss" scoped>
  .column {
    position: relative;
  }

  textarea {
    padding: 10px;
    width: 100%;
    max-width: 100%;
    resize: vertical;
  }

  .quiz-title {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: none;

    border-bottom: 1px dotted #aaa;
    font-size: 1.5em;
  }

  .question-helper {
    padding: 5px;
    color: #aaa;
  }

  .column {
    padding: 15px;
  }

  .answer-icon {
    width: 100%;
    display: block;
    text-align: center;
    padding: 3px;
    border: 1px dashed #aaa;
    margin-bottom: 5px;
    cursor: pointer;
    &.is-correct {
      background-color: orangered;
      border: 1px solid orangered;
      color: white;
    }
  }
</style>

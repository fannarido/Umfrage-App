<template>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <button
            class="btn btn-info"
            data-bs-toggle="modal"
            :data-bs-target="'#questionAnswer-' + questionId"
            v-if="!isAnswer"
        >
            <i class="fa-solid fa-hexagon-plus"></i>Umfrage der {{ group.name }}
        </button>
        <div class="card text-dark" style="background-color: #00aeef" v-else>
            <div class="card-body text-lg">
                Vielen Danke für Ihr Teilnahme!
            </div>
        </div>
        <!-- Vertically centered modal -->
        <!-- Modal -->
        <div
            class="modal fade"
            :id="'questionAnswer-' + questionIndex"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
            v-for="(question, questionIndex) in group.questions"
            :key="questionIndex"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title text-center text-danger"
                            id="exampleModalLabel"
                        >
                            {{ question.heading }}
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body pt-0">
                        <h5
                            class="modal-title text-center mb-4"
                            id="exampleModalLabel"
                        >
                            {{ question.sub_heading }}
                        </h5>
                        <div
                            v-for="(answer, index) in question.answers"
                            :key="index"
                            class="answer-div"
                            :class="answer.isActive ? 'active' : ''"
                            @click="changeAnswer(index, questionIndex)"
                        >
                            {{ answer.answer }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            v-if="questionIndex !== 0"
                            @click="previousQuestion(questionIndex)"
                        >
                            Vorherige Frage
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="nextQuestion(questionIndex)"
                            v-if="questionIndex !== group.questions.length - 1"
                        >
                            NeNächste Frage
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="sendAnswers(questionIndex)"
                            v-else
                        >
                            Fragen Abschicken
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Toast, Dialog } from 'vant';

export default {
  props: ['slug'],
  data() {
    return {
      isAnswer: false,
      group: [],
      questionId: 0,
      test: null,
      options: [
        {
          id: 1,
          title: 'Car',
          isActive: true,
        },
        {
          id: 2,
          title: 'Bike',
          isActive: false,
        },
        {
          id: 3,
          title: 'Bus',
          isActive: false,
        },
      ],
    };
  },
  methods: {
    changeAnswer(answerIndex, questionIndex) {
      for (
        let i = 0;
        i < this.group.questions[questionIndex].answers.length;
        i += 1
      ) {
        this.group.questions[questionIndex].answers[i].isActive = false;
      }
      this.group.questions[questionIndex].answers[
        answerIndex
      ].isActive = true;
    },
    nextQuestion(index) {
      $(`#questionAnswer-${index}`).modal('hide');
      $(`#questionAnswer-${index + 1}`).modal('show');
    },
    previousQuestion(index) {
      $(`#questionAnswer-${index}`).modal('hide');
      $(`#questionAnswer-${index - 1}`).modal('show');
    },
    async fetchQuestions() {
      try {
        const res = await axios.get(`/groups/${this.slug}`);
        this.group = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async sendAnswers(index) {
      try {
        const res = await axios.post('/answers', this.group);
        $(`#questionAnswer-${index}`).modal('hide');
        Toast.success('Gesendet');
        this.isAnswer = true;
        const answeredQuestions = JSON.parse(
          localStorage.getItem('answeredQuestions'),
        );
        answeredQuestions.push(this.slug);
        localStorage.setItem(
          'answeredQuestions',
          JSON.stringify(answeredQuestions),
        );
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchQuestions();
    const answeredQuestions = JSON.parse(
      localStorage.getItem('answeredQuestions'),
    );
    this.isAnswer = answeredQuestions.filter((question) => question === this.slug)
      .length > 0;
  },
};
</script>
<style scoped>
.header__top__right__auth {
    margin-left: 5px;
    margin-right: 10px;
}
.header__top {
    background: #e8f0fe;
    box-shadow: 0 0px 0px rgba(0, 0, 0, 0.12),
        0 1px 2px rgba(107, 105, 105, 0.24);
}
.answer-div {
    border-radius: 5px;
    border: 1px solid rgb(196, 191, 191);
    padding: 10px;
    margin-bottom: 10px;
    cursor: pointer;
}
.answer-div:active {
    background: #00aeef;
    color: white;
    border: 1px solid transparent;
}
.answer-div.active {
    background: #00aeef;
    color: white;
    border: 1px solid transparent;
}
</style>

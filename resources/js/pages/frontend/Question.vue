<template>
    <div>
        <!-- Humberger Begin -->
        <div class="humberger__menu__overlay"></div>
        <div class="humberger__menu__wrapper">
            <div class="humberger__menu__logo">
                <h3> </h3>
            </div>
            <div class="humberger__menu__widget">
                <div class="header__top__right__auth login_auth">
                    <a href="/auth/login" v-if="!$auth.check()" class="mr-2"
                        ><i class="fa fa-sign-in-alt"></i> Einloggen
                    </a>
                    <a href="" @click.prevent="logout()" v-if="$auth.check()"
                        ><i class="fa fa-user"></i> Abmelden
                    </a>
                </div>
            </div>
            <nav class="humberger__menu__nav mobile-menu">
                <ul>
                    <li
                        :class="
                            !linkIsActive('/group') &&
                            !linkIsActive('/question') &&
                            !linkIsActive('/result')
                        "
                        @click="$router.push('/')"
                    >
                        <a href="/">Startseite</a>
                    </li>
                    <li
                        :class="linkIsActive('/group') ? 'active' : ''"
                        @click="$router.push('/group')"
                    >
                        <a href="/group">Gruppe</a>
                    </li>
                    <li
                        :class="linkIsActive('/question') ? 'active' : ''"
                        @click="$router.push('/question')"
                    >
                        <a href="/question">Frage</a>
                    </li>
                    <li
                        :class="linkIsActive('/result') ? 'active' : ''"
                        @click="$router.push('/result')"
                    >
                        <a href="/result">Resultat</a>
                    </li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
            <div class="header__top__right__social">
                <b>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</b>
            </div>
        </div>
        <!-- Humberger End -->

        <!-- Header Section Begin -->
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row pt-3">
                        <div class="col-lg-6">
                            <div class="header__top__left">
                                <ul>
                                    <li class="d-flex">
                                        <h3 class="my-auto ml-3">

                                        </h3>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="header__top__right">
                                <div
                                    class="header__top__right__social"
                                    v-if="$auth.check()"
                                >
                                    Hallo,
                                    <b
                                        >{{ $auth.user().name }} -
                                        {{ $auth.user().email }}</b
                                    >
                                </div>
                                <div
                                    class="header__top__right__auth"
                                    v-if="!$auth.check()"
                                >
                                    <a
                                        href="#"
                                        @click.prevent="
                                            $router.push('/auth/login')
                                        "
                                        ><i class="fa fa-sign-in-alt"></i>
                                        Einloggen
                                    </a>
                                </div>

                                <div
                                    class="header__top__right__auth ml-2"
                                    v-if="!$auth.check()"
                                >
                                    <a
                                        href="#"
                                        @click.prevent="
                                            $router.push('/auth/register')
                                        "
                                        ><i class="fa fa-user"></i> Registrieren
                                    </a>
                                </div>
                                <div
                                    class="header__top__right__auth"
                                    v-if="$auth.check()"
                                >
                                    <a href="#" @click.prevent="logout()"
                                        ><i class="fas fa-sign-out-alt"></i
                                        >Abmelden
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row" v-if="!$route.path.includes('login')">
                    <div class="col-lg-3">
                        <div class="header__logo">
                            <a href="/"><img alt="" /></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul class="text-center">
                                <li
                                    :class="
                                        !linkIsActive('/shop') &&
                                        !linkIsActive('/group') &&
                                        !linkIsActive('/question') &&
                                        !linkIsActive('/result')
                                    "
                                >
                                    <a
                                        href=""
                                        @click.prevent="$router.push('/')"
                                        >Startseite</a
                                    >
                                </li>
                                <li
                                    :class="
                                        linkIsActive('/group') ? 'active' : ''
                                    "
                                >
                                    <a @click.prevent="$router.push('/group')"
                                        >Gruppen</a
                                    >
                                </li>
                                <li
                                    :class="
                                        linkIsActive('/question')
                                            ? 'active'
                                            : ''
                                    "
                                >
                                    <a
                                        @click.prevent="
                                            $router.push('/question')
                                        "
                                        >Frage</a
                                    >
                                </li>
                                <li
                                    :class="
                                        linkIsActive('/result') ? 'active' : ''
                                    "
                                >
                                    <a @click.prevent="$router.push('/result')"
                                        >Resultat</a
                                    >
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->
        <!-- Hero Section Begin -->
        <section
            class="hero"
            v-if="
                !$route.path.includes('login') &&
                !$route.path.includes('register') &&
                !$route.path.includes('checkout') &&
                !$route.path.includes('new-password') &&
                !$route.path.includes('forget-password')
            "
        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-4" v-if="isDep">
                        <div class="hero__categories">
                            <div class="hero__categories__all">
                                <i class="fa fa-bars"></i>
                                <span>Alle Gruppen</span>
                            </div>
                            <ul :style="isNone ? 'display: none' : ''">
                                <li
                                    v-for="(group, index) in groups"
                                    :key="index"
                                    :class="group.isActive ? 'active' : ''"
                                    class="d-flex justify-content-between"
                                    @click="test(index)"
                                >
                                    <div>
                                        <b>{{ group.name }}</b> ({{
                                            group.date
                                        }})
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="hero__search" v-if="isSearch">
                            <div
                                class="hero__search__form d-flex"
                                style="width: 100%"
                            >
                                <!-- <form action="#"> -->
                                <input
                                    type="email"
                                    v-model="search"
                                    class="form-control mr-2"
                                    placeholder="Group Name"
                                />

                                <div class="mb-3">
                                    <date-picker
                                        placeholder="Group Date"
                                        v-model="dateTime"
                                        valueType="format"
                                    ></date-picker>
                                </div>
                                <button
                                    class="ml-2 btn btn-primary"
                                    @click="searchGroup()"
                                >
                                    SUCHEN
                                </button>
                                <button
                                    class="btn btn-info"
                                    @click="fetchGroups()"
                                >
                                    Alle
                                </button>
                                <!-- </form> -->
                            </div>
                            <button
                                class="btn btn-info mt-3"
                                data-bs-toggle="modal"
                                data-bs-target="#createNewQuestionModal"
                                @click="isCreate = true"
                            >
                                Frage erstellen
                            </button>
                            <div>
                                <!-- Vertically centered modal -->
                                <!-- Modal -->
                                <div
                                    class="modal fade"
                                    id="createNewQuestionModal"
                                    tabindex="-1"
                                    aria-labelledby="exampleModalLabel"
                                    aria-hidden="true"
                                >
                                    <div
                                        class="modal-dialog modal-dialog-centered"
                                    >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="exampleModalLabel"
                                                    v-if="isCreate"
                                                >
                                                    Frage erstellen für
                                                    <span class="text-danger"
                                                        >(
                                                        {{ showGroupName }}
                                                        )</span
                                                    >
                                                </h5>
                                                <h5
                                                    class="modal-title"
                                                    id="exampleModalLabel"
                                                    v-else
                                                >
                                                    Frage bearbeiten
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label
                                                        for="groupName"
                                                        class="form-label"
                                                        >Überschrift</label
                                                    >
                                                    <input
                                                        type="email"
                                                        v-model="
                                                            newQuestion.heading
                                                        "
                                                        class="form-control"
                                                        id="groupName"
                                                    />
                                                    <span
                                                        class="text-danger text-xs"
                                                        v-if="errors.heading"
                                                        >{{
                                                            errors.heading
                                                        }}</span
                                                    >
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        for="groupName"
                                                        class="form-label"
                                                        >Unterüberschrift</label
                                                    >
                                                    <input
                                                        type="email"
                                                        v-model="
                                                            newQuestion.sub_heading
                                                        "
                                                        class="form-control"
                                                        id="groupName"
                                                    />
                                                    <span
                                                        class="text-danger text-xs"
                                                        v-if="
                                                            errors.sub_heading
                                                        "
                                                        >{{
                                                            errors.sub_heading
                                                        }}</span
                                                    >
                                                </div>
                                                <button
                                                    class="btn btn-outline-dark"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseExample"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample"
                                                >
                                                    Antwort hinzufügen
                                                </button>
                                                <span
                                                    class="text-danger text-xs"
                                                    v-if="errors.answer"
                                                    >{{ errors.answer }}</span
                                                >
                                                <div
                                                    class="collapse mt-2"
                                                    id="collapseExample"
                                                >
                                                    <div class="card card-body">
                                                        <div class="mb-3">
                                                            <label
                                                                for="groupName"
                                                                class="form-label"
                                                                >Answer</label
                                                            >
                                                            <input
                                                                type="email"
                                                                v-model="
                                                                    answer.answer
                                                                "
                                                                class="form-control"
                                                                id="groupName"
                                                            />
                                                        </div>
                                                        <div
                                                            class="form-group d-flex justify-content-center mt-3"
                                                        >
                                                            <button
                                                                type="button"
                                                                class="btn btn-danger px-5"
                                                                @click="
                                                                    addAnswerToQuestion()
                                                                "
                                                            >
                                                                Einfügen
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ol
                                                    class="list-group list-group-numbered"
                                                >
                                                    <li
                                                        class="list-group-item d-flex justify-content-between"
                                                        v-for="(
                                                            answer, index
                                                        ) in newQuestion.answers"
                                                        :key="index"
                                                    >
                                                        <b>{{
                                                            answer.answer
                                                        }}</b
                                                        ><i
                                                            class="fas fa-trash-alt text-danger"
                                                            style="
                                                                cursor: pointer;
                                                            "
                                                            @click="
                                                                removeAnswers(
                                                                    index
                                                                )
                                                            "
                                                        ></i>
                                                    </li>
                                                </ol>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Abbruch
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    @click="
                                                        isCreate
                                                            ? addNewQuestion()
                                                            : updateQuestion()
                                                    "
                                                >
                                                    {{
                                                        isCreate
                                                            ? ""
                                                            : ""
                                                    }}
                                                    Frage erstellen
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="my-2"
                            v-for="(question, index) in questions"
                            :key="index"
                        >
                            <button
                                class="btn btn-outline-dark"
                                type="button"
                                data-bs-toggle="collapse"
                                :data-bs-target="'#question' + index"
                                aria-expanded="false"
                                :aria-controls="'#question' + index"
                            >
                                {{ question.heading }}
                            </button>
                            <div class="collapse my-2" :id="'question' + index">
                                <div class="card card-body">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="my-1">
                                            {{ question.sub_heading }}
                                        </h3>
                                        <div>
                                            <button
                                                class="btn btn-danger mb-2"
                                                @click="
                                                    deleteQuestionById(
                                                        question.id
                                                    )
                                                "
                                            >
                                                Löschen
                                            </button>
                                            <button
                                                class="btn btn-info mb-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#createNewQuestionModal"
                                                @click="
                                                    (newQuestion = question),
                                                        (isCreate = false)
                                                "
                                            >
                                                Frage bearbeiten
                                            </button>
                                        </div>
                                    </div>
                                    <ol class="list-group list-group-numbered">
                                        <li
                                            class="list-group-item"
                                            v-for="(
                                                answer, index
                                            ) in question.answers"
                                            :key="index"
                                        >
                                            <b>{{ answer.answer }}</b>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
    </div>
</template>
<script>
import { Toast, Dialog } from 'vant';
import DatePicker from 'vue2-datepicker';

export default {
  components: { DatePicker },
  props: {
    isSearch: {
      type: Boolean,
      default: true,
    },
    isSecondHead: {
      type: Boolean,
      default: true,
    },
    isDep: {
      type: Boolean,
      default: true,
    },
    isNone: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      isCreate: true,
      groupDate: null,
      groups: [],
      search: null,
      group: [],
      dateTime: null,
      groupName: null,
      questions: null,
      errors: { name: [], dateTime: [] },
      //   answer: {},
      answer: {},
      newQuestion: {
        heading: null,
        sub_heading: null,
        group_id: null,
        answers: [],
      },
    };
  },
  computed: {
    showGroupName() {
      return this.group.name;
    },
  },
  methods: {
    deleteQuestionById(id) {
      Dialog.confirm({
        title: 'Möchten Sie die Frage wirklich löschen?',
        cancelButtonText: 'Nein',
        confirmButtonText: 'Ja',
      })
        .then(() => {
          this.deleteQuestion(id);
          Toast.success('Deleted!');
        })
        .catch(() => {});
    },
    async deleteQuestion(id) {
      try {
        const res = await axios.delete(`/questions/${id}`, {
          params: {
            questionId: id,
          },
        });
        this.fetchGroups();
      } catch (error) {
        console.log(error);
      }
    },
    removeAnswers(index) {
      this.newQuestion.answers.splice(index, 1);
    },
    addAnswerToQuestion() {
      this.newQuestion.answers.push(
        JSON.parse(JSON.stringify(this.answer)),
      );
      this.answer = {};
    },
    async copyText() {
      const copyText = this.$refs.shareLink;
      await navigator.clipboard.writeText(copyText.textContent);
      Toast.success('Kopiert');
    },
    /* example link = '/settings' */
    linkIsActive(link) {
      const paths = Array.isArray(link) ? link : [link];
      const res = paths.some(
        (path) => this.$route.path.indexOf(path) === 0,
      );
      if (res) {
        return true;
      }
      return false;
    },
    async fetchGroups() {
      try {
        const res = await axios.get('/groups');
        this.groups = res.data.data;
        this.group = this.groups[0];
        this.groups[0].isActive = true;
        if (this.groups.length === 0) {
          Dialog.alert({
            message: 'Bitte erstellen Sie zuerst eine Gruppe',
            confirmButtonText: 'Ja',
          }).then(() => {
            // on close
          });
        }
        this.fetchQuestions();
      } catch (error) {
        console.log(error);
      }
    },
    async fetchQuestions() {
      try {
        const res = await axios.get(`/questions/${this.group.id}`);
        this.questions = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    test(index) {
      this.group = this.groups[index];
      for (let i = 0; i < this.groups.length; i += 1) {
        this.groups[i].isActive = false;
      }
      this.groups[index].isActive = true;
      this.fetchQuestions();
    },
    logout() {
      Dialog.confirm({
        title: 'Sie melden sich ab?',
        cancelButtonText: 'Nein',
        confirmButtonText: 'Ja',
      })
        .then(() => {
          this.$auth.logout({
            redirect: '/',
          });
          Toast.success('Abgemeldet!');
        })
        .catch(() => {});
    },
    async addNewQuestion() {
      try {
        this.errors = {};
        if (!this.newQuestion.heading) {
          this.errors.heading = 'Erforderliche Überschrift';
          this.isSignin = false;
          return false;
        }
        if (!this.newQuestion.sub_heading) {
          this.errors.sub_heading = 'Erforderliche Unterüberschrift';
          this.isSignin = false;
          return false;
        }
        if (this.newQuestion.answers.length === 0) {
          this.errors.answer = 'Bitte fügen Sie eine Antwort hinzu';
          this.isSignin = false;
          return false;
        }
        this.newQuestion.group_id = this.group.id;
        const res = await axios.post('/questions', this.newQuestion);
        this.fetchQuestions();
        $('#createNewQuestionModal').modal('hide');
        Toast.success('Erstellt!');
      } catch (err) {
        this.errors = err.response.data.errors;
      }
      return true;
    },
    async updateQuestion() {
      try {
        this.errors = { name: null, dateTime: null };
        this.newQuestion.group_id = this.group.id;
        const res = await axios.put(
          `/questions/${this.newQuestion.id}`,
          this.newQuestion,
        );
        this.fetchQuestions();
        $('#createNewQuestionModal').modal('hide');
        Toast.success('Erstellt!');
      } catch (err) {
        this.errors = err.response.data.errors;
      }
    },
    async searchGroup() {
      try {
        const res = await axios.get('/groups', {
          params: {
            search: this.search,
            dateTime: this.dateTime,
          },
        });
        this.groups = res.data.data;
        this.group = this.groups[0];
        this.groups[0].isActive = true;
        this.fetchQuestions();
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchGroups();
    if (!this.$auth.check()) {
      this.$router.push('/auth/login');
    }
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
.btn-outline-dark {
    width: 100% !important;
}
</style>

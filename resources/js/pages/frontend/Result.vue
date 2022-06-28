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
                        ><i class="fa fa-sign-in-alt"></i> Loggin
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
                                        ><i class="fa fa-user"></i>
                                        Registrieren
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
                                        >Gruppe</a
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
                                <span> Alle Fragen </span>
                            </div>
                            <ul :style="isNone ? 'display: none' : ''">
                                <li
                                    @click="
                                        fetchAnswersWithSelectedAnswers(
                                            question.id,
                                            index
                                        )
                                    "
                                    v-for="(question, index) in questions"
                                    :key="index"
                                    :class="question.isActive ? 'active' : ''"
                                >
                                    <div>
                                        <b>{{ question.heading }}</b>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="d-flex">
                            <div class="col-10 m-0 p-0">
                                <v-select
                                    v-model="groupId"
                                    :options="groups"
                                    :reduce="(data) => data.id"
                                    label="name"
                                />
                            </div>
                            <div class="col-2 p-0 d-flex justify-content-end">
                                <button
                                    class="btn btn-primary"
                                    @click="searchGroup()"
                                >
                                    SUCHEN
                                </button>
                            </div>
                        </div>
                        <div
                            class="d-flex justify-content-center"
                            style="
                                border: 1px solid black;
                                border-radius: 5px;
                                padding: 30px;
                                margin-top: 20px;
                            "
                        >
                            <div
                                class="my-auto"
                                v-if="series.length > 0 && isAnswers"
                            >
                                <VueApexCharts
                                    width="500"
                                    :options="options"
                                    :series="series"
                                ></VueApexCharts>
                            </div>
                            <div v-else>
                                Auf diese Frage gibt es keine Antworten.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import VueApexCharts from 'vue-apexcharts';
import { Toast, Dialog } from 'vant';

export default {
  components: { VueApexCharts },
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
      isAnswers: false,
      questions: [],
      groups: [],
      groupId: null,
      options: {
        chart: {
          id: 'vuechart-example',
          type: 'donut',
        },
        labels: [],
      },
      series: [],
    };
  },
  methods: {
    async fetchGroups() {
      try {
        const res = await axios.get('/groups');
        this.groups = res.data.data;
        this.group = this.groups[0];
        this.groupId = this.group.id;
        this.fetchQuestions();
      } catch (error) {
        console.log(error);
      }
    },
    async fetchQuestions() {
      try {
        const res = await axios.get(`/questions/${this.group.id}`);
        this.questions = res.data.data;
        this.fetchAnswersWithSelectedAnswers(this.questions[0].id, 0);
      } catch (error) {
        console.log(error);
      }
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
    async searchGroup() {
      try {
        this.group = this.groups.filter(
          (group) => group.id === this.groupId,
        )[0];
        this.fetchQuestions();
      } catch (error) {
        console.log(error);
      }
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
    async fetchAnswersWithSelectedAnswers(id, questionIndex) {
      try {
        const res = await axios.get('/answers/with-selected-answers', {
          params: {
            question_id: id,
          },
        });
        for (let i = 0; i < this.questions.length; i += 1) {
          this.questions[i].isActive = false;
        }
        this.questions[questionIndex].isActive = true;
        this.series = res.data.series;
        //   this.options.labels = res.data.labels;
        //   this.oldLabels = res.data.labels;
        this.options = {
          chart: {
            id: 'vuechart-example',
            type: 'donut',
          },
          labels: res.data.labels,
        };
        this.isAnswers = res.data.isAnswers || false;
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

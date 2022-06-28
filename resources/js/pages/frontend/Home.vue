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
                                ? 'active'
                                : ''
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
                                        ><i class="fas fa-sign-out-alt"></i>
                                       Abmelden
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
                                            ? 'active'
                                            : ''
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
            <h1 class="text-center">Umfrage starten</h1>
        </section>
    </div>
</template>
<script>
import { Toast, Dialog } from 'vant';

export default {
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
  methods: {
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
.hero__categories ul {
    padding: 10px;
}
.hero__categories ul li {
    /* border: 1px solid red; */
    padding: 8px;
    margin-bottom: 5px;
    border-radius: 5px;
    cursor: pointer;
}
.hero__categories ul li.active {
    border: 1px solid transparent;
    background: #00aeef;
    color: #fff;
}
</style>

<template>
    <div>
        <!-- Humberger Begin -->
        <div class="humberger__menu__overlay"></div>
        <div class="humberger__menu__wrapper">
            <div class="humberger__menu__logo">
                <h3>Umfragenseite</h3>
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
                        <a href="/group">Gruppens</a>
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
                                <span>Alle Gruppen</span>
                            </div>
                            <ul :style="isNone ? 'display: none' : ''">
                                <li
                                    v-for="(group, index) in groups"
                                    :key="index"
                                    :class="group.isActive ? 'active' : ''"
                                    class="d-flex justify-content-between"
                                >
                                    <div
                                        @click.prevent="
                                            changeShareLink(group.slug, index)
                                        "
                                    >
                                        <b>{{ group.name }}</b> ({{
                                            group.date
                                        }})
                                    </div>
                                    <div>
                                        <i
                                            class="fa-solid fa-pen-to-square pt-1 text-black pr-1"
                                            style="cursor: pointer"
                                            @click="fetchGroupById(group.id)"
                                        ></i>

                                        <i
                                            class="fas fa-trash-alt pt-1 text-danger"
                                            style="cursor: pointer"
                                            @click.self="
                                                deleteGroupById(group.id)
                                            "
                                        ></i>
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
                                    placeholder="Gruppen Name"
                                />

                                <div class="mb-3">
                                    <date-picker
                                        placeholder="Datum"
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
                        </div>

                        <div class="hero__item" v-if="isSecondHead">
                            <div class="card d-flex pb-4 px-3">
                                <div class="card-body">
                                    Gruppenfreigabe-Link -
                                    <a
                                        :href="
                                            'localhost:8000/groups/' + groupSlug
                                        "
                                        ><b ref="shareLink"
                                            >localhost:8000/groups/{{
                                                groupSlug
                                            }}</b
                                        ></a
                                    >
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button
                                        class="btn btn-primary"
                                        @click="copyText()"
                                    >
                                        Gruppen Umfrage teilen
                                    </button>
                                    <button
                                        class="btn btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#createNewGroupModal"
                                    >
                                        <i class="fa-solid fa-hexagon-plus"></i
                                        >Neue Gruppe erstellen
                                    </button>
                                </div>
                                <!-- The button used to copy the text -->
                            </div>
                            <div>
                                <!-- Vertically centered modal -->
                                <!-- Modal -->
                                <div
                                    class="modal fade"
                                    id="createNewGroupModal"
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
                                                >
                                                    Neue Gruppe erstellen
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
                                                        >Gruppen Name</label
                                                    >
                                                    <input
                                                        type="email"
                                                        v-model="groupName"
                                                        class="form-control"
                                                        id="groupName"
                                                    />
                                                    <span
                                                        class="text-danger"
                                                        v-if="errors.name"
                                                        >{{
                                                            errors.name[0] || ""
                                                        }}</span
                                                    >
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        for="dateTime"
                                                        class="form-label"
                                                        >Terminzeit</label
                                                    ><br />
                                                    <date-picker
                                                        v-model="dateTime"
                                                        id="dateTime"
                                                        valueType="format"
                                                    ></date-picker>
                                                    <span
                                                        class="text-danger"
                                                        v-if="errors.dateTime"
                                                        >{{
                                                            errors
                                                                .dateTime[0] ||
                                                            ""
                                                        }}</span
                                                    >
                                                </div>
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
                                                    @click="newGroup"
                                                >
                                                    Erstellen
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- //update group Modal -->
                            <div>
                                <!-- Vertically centered modal -->
                                <!-- Modal -->
                                <div
                                    class="modal fade"
                                    id="updateGroupModal"
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
                                                >
                                                    Gruppe aktualisieren
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
                                                        >Gruppen Name</label
                                                    >
                                                    <input
                                                        type="email"
                                                        v-model="
                                                            updatedGroup.name
                                                        "
                                                        class="form-control"
                                                        id="groupName"
                                                    />
                                                    <span
                                                        class="text-danger"
                                                        v-if="errors.updateName"
                                                        >{{
                                                            errors.updateName
                                                        }}</span
                                                    >
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        for="dateTime"
                                                        class="form-label"
                                                        >Terminzeit</label
                                                    ><br />
                                                    <date-picker
                                                        v-model="
                                                            updatedGroup.date
                                                        "
                                                        id="dateTime"
                                                        valueType="format"
                                                    ></date-picker>
                                                    <span
                                                        class="text-danger"
                                                        v-if="
                                                            errors.updateDatetime
                                                        "
                                                        >{{
                                                            errors.updateDatetime
                                                        }}</span
                                                    >
                                                </div>
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
                                                    @click="updateGroup"
                                                >
                                                    Aktualisieren
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
      groupDate: null,
      groups: [],
      updatedGroup: {},
      search: null,
      groupSlug: null,
      dateTime: null,
      groupName: null,
      errors: { name: [], dateTime: [] },
    };
  },
  methods: {
    deleteGroupById(id) {
      Dialog.confirm({
        title: 'Möchten Sie die Gruppe wirklich löschen?',
        cancelButtonText: 'Nein',
        confirmButtonText: 'Ja',
      })
        .then(() => {
          this.deleteGroup(id);
          Toast.success('Deleted!');
        })
        .catch(() => {});
    },
    async deleteGroup(id) {
      try {
        const res = await axios.delete(`/groups/${id}`, {
          params: {
            groupId: id,
          },
        });
        this.fetchGroups();
      } catch (error) {
        console.log(error);
      }
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
        this.groupSlug = this.groups[0].slug;
        this.groups[0].isActive = true;
        console.log(this.groups);
      } catch (error) {
        console.log(error);
      }
    },
    changeShareLink(slug, index) {
      this.groupSlug = slug;
      for (let i = 0; i < this.groups.length; i += 1) {
        this.groups[i].isActive = false;
      }
      this.groups[index].isActive = true;
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
          Toast.success('Ausgeloggt!');
        })
        .catch(() => {});
    },
    async newGroup() {
      try {
        this.errors = { name: null, dateTime: null };
        const res = await axios.post('/groups', {
          name: this.groupName,
          dateTime: this.dateTime,
        });
        this.fetchGroups();
        $('#createNewGroupModal').modal('hide');
        Toast.success('Erstellen');
      } catch (err) {
        this.errors = err.response.data.errors;
      }
    },

    async fetchGroupById(id) {
      try {
        const res = await axios.get(`/groups/update/${id}`);
        this.updatedGroup = res.data.data;
        console.log(this.updatedGroup);
        $('#updateGroupModal').modal('show');
      } catch (error) {
        console.log(error);
      }
    },
    async updateGroup() {
      try {
        this.errors = { name: null, dateTime: null };
        const res = await axios.put(
          `/groups/${this.updatedGroup.id}`,
          this.updatedGroup,
        );
        this.fetchGroups();
        $('#updateGroupModal').modal('hide');
        Toast.success('Erstellen');
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
</style>

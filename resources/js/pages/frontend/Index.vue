<template>
    <div>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
  methods: {
    async fetchContact() {
      try {
        const res = await axios.get('/sitecontacts');
        this.$store.commit('setContact', res.data.data[0]);
      } catch (error) {
        console.log(error);
      }
    },
    setLocalstorage(name, data) {
      localStorage.setItem(name, JSON.stringify(data));
    },
  },
  mounted() {
    this.fetchContact();
    if (!localStorage.getItem('cartProducts')) {
      this.setLocalstorage('cartProducts', []);
    }
  },
};
</script>
<style>
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
.header__menu a {
    cursor: pointer;
}
</style>

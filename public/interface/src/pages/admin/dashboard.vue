<template>
  <!--顶部导航-->
  <section>
    <com-progress-bar loading.sync="loading"></com-progress-bar>
    <mu-flex>
      <mu-flex v-if="isAdmin" style="width:20vw">
        <!--左侧菜单-->
        <com-admin-menu></com-admin-menu>
      </mu-flex>
      <mu-flex fill direction="column" style="width:80vw">
        <com-admin-top-nav v-if="isAdmin" class="fixed">
        </com-admin-top-nav>
        <!--<section id="dashboardMain" class="full-width full-height" style="background:white;">-->
        <transition appear name="fade">
          <router-view class="full-width" style="background: white;min-height:100vh;margin-top: 110px;">
          </router-view>
        </transition>
        <!--</section>-->
      </mu-flex>
    </mu-flex>
  </section>

</template>

<script>
  export default {
    name: "dashboard",
    data() {
      return {
        isAdmin: false,
        loading: true,
      }
    },
    methods: {},
    created() {
      this.isAdmin = this.$store.getters.isAdmin;
    },
    computed: {
      handlerIsAdmin: function () {
        return this.$store.getters.isAdmin;
      }
    },
    watch: {
      handlerIsAdmin: function (v) {
        this.isAdmin = v;
      }
    },
    components: {
      'com-admin-menu': () => import('./components/adminMenu'),
      'com-admin-top-nav': () => import('./components/adminTopNav'),
      comProgressBar: () => import('@/pages/components/progressBar'),
    }
  }
</script>

<style scoped>

</style>

<template>
  <header>
    <mu-breadcrumbs divider=">">
      <mu-breadcrumbs-item v-for="item in urls" :key="item.title" :to="item.path">
        {{item.title}}
      </mu-breadcrumbs-item>
    </mu-breadcrumbs>
  </header>
</template>

<script>
  export default {
    name: "breadcrumbs",
    data() {
      return {
        urls: []
      }
    },
    mounted() {
      this.breadcrumbsInit();
    },
    watch: {
      // 如果路由有变化，会再次执行该方法
      '$route': 'breadcrumbsInit'
    },
    methods: {
      breadcrumbsInit: function () {
        let vm = this;
        vm.urls = [];
        //  初始化分析路径
        vm.$route.matched.map((e, i) => {
          if (e.path !== "") {
            vm.urls.push({
              icon: "",
              path: vm.$route.matched.length == i + 1 ? "" : e.path,
              title: e.meta.title || e.name
            });
          }
        });
      }
    }
  }
</script>

<style scoped>

</style>

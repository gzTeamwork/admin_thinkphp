<template>
  <mu-container style="text-align: left;padding-top:1em;">
    <div slot="header">基本配置</div>
    <mu-form :model="form" :label-position="'top'">
      <mu-form-item prop="input" label="管理员账户">
        <mu-text-field v-model="form.account"></mu-text-field>
      </mu-form-item>
    </mu-form>
  </mu-container>

</template>

<script>
  import adminApi from '@/pages/admin/adminApi.js';

  export default {
    name: "adminConfiguration",
    data() {
      return {
        form: {}
      }
    },
    created() {
      //  配置页面创建的时候,加载服务器数据
      adminApi.getSystemConfiguration();
    },
    computed:{
      handleSystemConfiguration:function(){
        // return this.$store.getters.
      }
    },
    methods: {
      toggle: function (panel) {
        this.panel = panel === this.panel ? '' : panel;
      }
    },

  }
</script>

<style scoped>

</style>

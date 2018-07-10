<template>
  <mu-container>
    <!--新增角色-->
    <mu-dialog title="添加新的权限角色" width="800" max-width="80%" :esc-press-close="false"
               :overlay-close="false" :open.sync="openAlert">
      <mu-form :model="form" label-position="top">
        <!--角色名称-->
        <mu-form-item prop="input" label="角色名称(中文)">
          <mu-text-field v-model="form.label"></mu-text-field>
        </mu-form-item>
        <!--角色key-->
        <mu-form-item label="角色标识(英文)">
          <mu-text-field v-model="form.name"></mu-text-field>
        </mu-form-item>
        <!--权限选择-->
        <mu-form-item label="角色配置权限">
          <mu-text-field v-model="form.value"></mu-text-field>
        </mu-form-item>
        <mu-form-item label="是否可用">
          <mu-switch v-model="form.isActive"></mu-switch>
        </mu-form-item>
      </mu-form>
      <mu-button slot="actions" flat color="primary" @click="closeAlertDialog">取消</mu-button>
      <mu-button slot="actions" flat color="primary" @click="newRoleSub">确认添加</mu-button>
    </mu-dialog>
  </mu-container>
</template>

<script>
  import userApi from './userApi';

  export default {
    name: "roleNewDialog",
    props: ["openAlert"],
    data() {
      return {
        form: {
          label: null,
          name: null,
          value: null,
          isActive: false,
        }
      }
    },
    watch: {
      openAlert: function (v) {
        if (v === true) {
          //  被显示
          // userApi.getNewRoleFields();
        } else {

        }
      }
    },
    methods: {
      openAlertDialog() {
        this.openAlert = true;
      },
      closeAlertDialog() {
        // this.openAlert = false;
        this.$emit('openAlert', false);
      },
      /**
       * 提交新的角色
       */
      newRoleSub() {
        userApi.newRoleSub(this.form);
        this.closeAlertDialog();
      }
    }
  }
</script>

<style scoped>

</style>

<template>
  <div>
    <mu-form :model="form" :label-position="'left'" label-width="100">
      <mu-form-item prop="input" label="栏目标题">
        <mu-text-field v-model="form.title"></mu-text-field>
      </mu-form-item>
      <mu-form-item prop="input" label="标识(En)">
        <mu-text-field v-model="form.name"></mu-text-field>
      </mu-form-item>
      <mu-form-item prop="input" label="上级栏目">
        <mu-select filterable v-model="filterable.cateSearch" full-width @change="eventParentCateChange">
          <mu-option v-for="(cate,index) in handlerGetCateList" :key="index" :label="cate.title||''" :value="cate.id"></mu-option>
        </mu-select>
      </mu-form-item>
      <mu-form-item prop="input" label="栏目简述">
        <mu-text-field v-model="form.description"></mu-text-field>
      </mu-form-item>
      <mu-button primary @click="eventNewCateSubmit">提交</mu-button>
    </mu-form>
  </div>
</template>

<script>
  import cateApi from './cateApi';

  export default {
    name: "cateNew",
    data() {
      return {
        cateList: [{
          title: '根目录'
        }],
        form: {
          title: '',
          name: '',
          pid: 0,
          description: ''
        },
        filterable: {
          cateSearch: '',
        }
      }
    },
    computed: {
      handlerGetCateList: function () {
        return this.$store.getters.getCateList;
      }
    },
    // watch: {
    //   handlerGetCateList: function (v, ov) {
    //     this.cateList = v;
    //   }
    // },
    methods: {
      eventParentCateSelect: function () {
        cateApi.getCateList();
      },
      eventNewCateSubmit: function () {
        cateApi.setCateNew(this.form);
      },
      eventParentCateChange: function (value) {
        this.form.pid = value || 0;
      }
    },
    mounted() {
      this.eventParentCateSelect();
    }
  }
</script>

<style scoped>

</style>

<template>
  <mu-container>
    <com-multi-params-form :datas.sync="form" @saveData="eventSaveAdvanceds">
    </com-multi-params-form>
    <!--<mu-form :model="newForm">-->
    <!--<mu-sub-header>-->
    <!--新设置-->
    <!--</mu-sub-header>-->
    <!--<mu-row gutter justify-content="center">-->
    <!--<mu-col>-->
    <!--<mu-form-item>-->
    <!--<mu-text-field type="text" label="配置标题" v-model="newForm.title"></mu-text-field>-->
    <!--</mu-form-item>-->
    <!--</mu-col>-->
    <!--<mu-col>-->
    <!--<mu-form-item>-->
    <!--<mu-text-field type="text" label="配置名" v-model="newForm.name"></mu-text-field>-->
    <!--</mu-form-item>-->
    <!--</mu-col>-->
    <!--<mu-col>-->
    <!--<mu-form-item>-->
    <!--<mu-text-field type="text" label="配置内容" v-model="newForm.value"></mu-text-field>-->
    <!--</mu-form-item>-->
    <!--</mu-col>-->
    <!--<mu-col>-->
    <!--<mu-button @click="newAdvancedSubmit">-->
    <!--提交-->
    <!--</mu-button>-->
    <!--</mu-col>-->
    <!--</mu-row>-->
    <!--</mu-form>-->
    <!--<mu-form :model="form">-->
    <!--<mu-sub-header>-->
    <!--设置-->
    <!--</mu-sub-header>-->
    <!--</mu-form>-->
  </mu-container>
</template>

<script>
  import AdvancedApi from "./advancedApi"

  export default {
    name: "advancedList",
    components: {
      comMultiParamsForm: () => import('@/pages/components/multiParamsForm')
    },
    data() {
      return {
        form: [],
        newForm: {
          title: '', name: '', value: ''
        }
      }
    }, computed: {},
    mounted() {
      let vm = this;
      new Promise(resolve => {
        let advs = AdvancedApi.getAdvanceds({group: 'website'});
        resolve(advs)
      }).then(v => {
        vm.form = v;
      })
    },
    methods: {
      eventSaveAdvanceds(datas) {
        console.info('提交配置参数时间', datas);
        AdvancedApi.setAdvanceds(datas);
      }
    }
  }
</script>

<style scoped>

</style>

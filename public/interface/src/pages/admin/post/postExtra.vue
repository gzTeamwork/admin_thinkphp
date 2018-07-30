<template>
  <section>
    <h3>文章数据</h3>
    <template v-if="extraList.length>1">
      <mu-flex v-for="(e,i) in extraList" :key="i">
        <!--数字或文本-->
        <mu-text-field v-if="e.type=='string' || e.type=='number' || e.type=='address'" :label="e.title"
                       v-model="e.value"></mu-text-field>
        <!--时间-->
        <mu-date-input v-if="e.type=='datetime'" v-model="e.value"
                       hintext="0"
                       :label="e.title"
                       type="dateTime" full-width
                       landscape
                       actions></mu-date-input>

        <!--布尔-->
        <mu-switch v-if="e.type == 'boolean'" :label='e.title' v-model="e.value"></mu-switch>
      </mu-flex>
      <!--<com-city-picker :address="[extraList[7].value,extraList[8].value]"></com-city-picker>-->
    </template>
    <template v-else>
      <mu-flex fill align-items="center" justify-content="center">
        <mu-text-field icon="title" label="数据标题" label-float v-model="new_extra.title"></mu-text-field>
      </mu-flex>
      <mu-flex fill align-items="center" justify-content="center">
        <mu-text-field icon="title" label="数据标识(en)" label-float v-model="new_extra.name"></mu-text-field>
      </mu-flex>
      <mu-flex fill align-items="center" justify-content="center">
        <mu-button @click="eventInsertExtra">增加附加数据</mu-button>
      </mu-flex>
    </template>
  </section>
</template>

<script>
  export default {
    name: "postExtra",
    props: {
      extraList: {
        type: Array, default: function () {
          return [];
        }
      }
    },
    components: {
      'com-city-picker': () => import('@/pages/admin/components/cityPicker'),
    },
    data() {
      return {
        new_extra: {
          title: '', name: '', value: ''
        },
        // extraList: []
      }
    },
    methods: {
      eventInsertExtra: function () {
        this.extraList.push({...this.new_extra, value: ''})
        this.new_extra = {title: '', name: '', value: ''}
      }
    }
  }
</script>

<style scoped>

</style>

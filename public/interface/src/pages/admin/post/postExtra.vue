<template>
  <section>
    <h3>文章数据</h3>
    <mu-flex v-for="(e,i) in extraList" :key="i">
      <mu-text-field :label="e.title" v-model="e.value"></mu-text-field>
    </mu-flex>
    <mu-divider></mu-divider>
    <mu-flex fill align-items="center" justify-content="center">
      <mu-text-field icon="title" label="数据标题" label-float v-model="new_extra.title"></mu-text-field>
    </mu-flex>
    <mu-flex fill align-items="center" justify-content="center">
      <mu-text-field icon="title" label="数据标识(en)" label-float v-model="new_extra.name"></mu-text-field>
    </mu-flex>
    <mu-flex fill align-items="center" justify-content="center">
      <mu-button @click="eventInsertExtra">增加附加数据</mu-button>
    </mu-flex>
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

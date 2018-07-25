<template>
  <section class="gutter">
    <h3>文章数据模板</h3>
    <mu-grid-list class="gridlist-demo">
      <mu-sub-header>December</mu-sub-header>
      <mu-grid-tile v-for="index in 6" :key="index">
        <img :src="tile.image">
        <span slot="title">{{tile.title}}</span>
        <span slot="subTitle">by <b>{{tile.author}}</b></span>
        <mu-button slot="action" icon>
          <mu-icon value="star_border"></mu-icon>
        </mu-button>
      </mu-grid-tile>
    </mu-grid-list>
  </section>
</template>

<script>
  export default {
    name: "postTemplate",
    data() {
      return {
        templateList: [],
      }
    }
  }
</script>

<style scoped>

</style>

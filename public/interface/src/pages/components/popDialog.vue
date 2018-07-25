<template>
  <div class="no-title">
    <mu-dialog :open.sync="isShow" @close="close" scrollable :overlay-close="false">

      <template slot="title">
        <div class="abs-body full-width">
          <mu-float-button class="abs-item close-btn" icon="close" @click="close"/>
        </div>
      </template>
      <div style="padding-top: 1.6em;">
        <slot name="content">
        </slot>
      </div>
    </mu-dialog>
  </div>

</template>

<script>
  export default {
    name: 'postDialog',
    props: {
      isShow: {type: Boolean, default: false},
      title: {
        type: String,
        default: '暂无标题'
      }
    },
    data() {
      return {};
    },
    methods: {
      close() {
        this.$emit('isShow', false);
      }
    },
  };
</script>
<style lang="scss" scoped>

</style>

<template>
  <mu-snackbar :color="color" :open.sync="show" position="bottom-end">
    <mu-icon left :value="icon"></mu-icon>
    {{message}}
    <mu-button flat slot="action" color="#fff" @click="show = false">
      <mu-icon value="close"></mu-icon>
    </mu-button>
  </mu-snackbar>
</template>

<script>
  export default {
    name: "notice",
    data() {
      return {
        status: 'info',
        message: '',
        show: false,
        timeout: 3500,
        timer: null,
      }
    },
    computed: {
      /**
       * 消息弹框颜色
       * @returns {*}
       */
      color() {
        return {
          success: 'green300',
          info: 'blue200',
          warning: 'orange200',
          error: 'red200',
        }[this.status]
      },
      /**
       * 消息弹框图标
       * @returns {*}
       */
      icon() {
        return {
          success: 'check_circle',
          info: 'info',
          warning: 'priority_high',
          error: 'warning'
        }[this.status]
      },
      //  计算通知发生时间戳
      handlerNoticeTimeStamp: function () {
        return this.$store.getters.getNoticeTimeStamp;
      },
      // //  计算通知消息
      // handlerNoticeMessage: function () {
      //   return this.$store.getters.getNoticeMessage;
      // },
      // //  计算通知状态
      // handlerNoticeStatus: function () {
      //   return this.$store.getters.getNoticeStatus;
      // }
    },
    watch: {
      status: function (v, ov) {
        return {
          success: 'success',
          info: 'info',
          error: 'error',
          warning: 'warning',
        }[v]
      },
      //  消息时间戳发生改变 - 有新消息
      handlerNoticeTimeStamp: function () {
        this.openColorSnackbar();
      },
    },
    methods: {
      openColorSnackbar() {
        if (this.timer) clearTimeout(this.timer);
        this.message = this.$store.getters.getNoticeMessage;
        this.status = this.$store.getters.getNoticeStatus;
        this.show = true;
        this.timer = setTimeout(() => {
          this.message = null;
          this.show = false;
          this.status = 'info'
        }, this.timeout);
      }
    }
  }
</script>

<style scoped>

</style>

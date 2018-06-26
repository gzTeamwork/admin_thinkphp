<template>
  <mu-container>
    <mu-snackbar :color="color" :open.sync="show">
      <mu-icon left :value="icon"></mu-icon>
      {{message}}
      <mu-button flat slot="action" color="#fff" @click="show = false">Close</mu-button>
    </mu-snackbar>
  </mu-container>
</template>

<script>
  export default {
    name: "notice",
    data() {
      return {
        status: 'default',
        color: 'info',
        message: '',
        show: false,
        timeout: 1500,
        timer: null,
      }
    },
    computed: {
      icon() {
        return {
          success: 'check_circle',
          info: 'info',
          warning: 'priority_high',
          error: 'warning'
        }[this.color]
      },
      //  计算通知消息
      handlerNoticeMessage: function () {
        return this.$store.getters.getNoticeMessage;
      },
      //  计算通知状态
      handlerNoticeStatus: function () {
        return this.$store.getters.getNoticeStatus;
      }
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
      handlerNoticeMessage: function (v, ov) {
        this.openColorSnackbar(v);
      },
      handlerNoticeStatus: function (v, ov) {
        this.status = v || 'default';
      }
    },
    methods: {
      openColorSnackbar(msg) {
        // if (this.timer) clearTimeout(this.timer);
        this.show = true;
        this.message = msg;
        this.timer = setTimeout(() => {
          this.message = null;
          this.show = false;
          this.status = 'default'
        }, this.timeout);
      }
    }
  }
</script>

<style scoped>

</style>

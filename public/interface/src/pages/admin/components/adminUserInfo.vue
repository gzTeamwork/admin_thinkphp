<template>
  <mu-list>
    <mu-sub-header>当前用户</mu-sub-header>
    <mu-list-item avatar button :ripple="false">
      <mu-list-item-action>
        <mu-avatar>
          <!--<img src="../../assets/images/avatar1.jpg">-->
        </mu-avatar>
      </mu-list-item-action>
      <mu-list-item-title>Mike Li</mu-list-item-title>
      <mu-list-item-action>
        <mu-icon value="chat_bubble"></mu-icon>
      </mu-list-item-action>
    </mu-list-item>
  </mu-list>
</template>

<script>
  export default {
    name: "adminUserInfo"
  }
</script>

<style scoped>

</style>

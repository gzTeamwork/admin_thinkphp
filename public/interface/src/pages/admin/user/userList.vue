<template>
    <section>
        <h2>用户列表</h2>
        <mu-list>
            <mu-list-item v-for="(e,i) in userList" :key="i" avatar button :ripple="false">
                <mu-list-item-action>
                    <mu-icon value="star" color="pink"></mu-icon>
                </mu-list-item-action>
                <mu-list-item-title>{{e.nick_name}}</mu-list-item-title>
                <mu-list-item-action>
                </mu-list-item-action>
            </mu-list-item>
        </mu-list>
    </section>

</template>

<script>
    import userApi from './userApi.js';
    import userStore from './userVuex.js'

    export default {
        name: "userList",
        data() {
            return {
                userList: {}
            }
        },
        mounted() {
            // this.$store.registerModule("userStore", userStore);
            //  挂在时候开始获取数据
            userApi.getUserList();
        },
        computed: {
            handlerUserList: function () {
                return this.$store.getters.getUsers;
            }
        },
        watch: {
            handlerUserList: function (v) {
                this.userList = v;
            }
        }
    }
</script>

<style scoped>

</style>

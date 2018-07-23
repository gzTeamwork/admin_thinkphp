<template>
  <mu-container>
    <h2>用户列表</h2>
    <mu-data-table selectable select-all :selects.sync="selects" checkbox :loading="loading" :columns="columns"
                   :sort.sync="sort" @sort-change="handleSortChange"
                   :data="userList.slice(0, 6)" :no-data-text="'暂无数据'">
      <template slot-scope="scope">
        <td class="is-center">{{scope.row.id}}</td>
        <td class="is-center">{{scope.row.nick_name}}</td>
        <td class="is-center">
          <mu-icon :value="scope.row.isAdmin?'star':'people'" color="red300"></mu-icon>
        </td>
        <td class="is-center">{{scope.row.create_time}}</td>
        <td class="is-center">
          <mu-icon color="green300" v-if="scope.row.isActive" value="check_circle"></mu-icon>
          <mu-icon color="red300" v-else="scope.row.isActive" value="highlight_off"></mu-icon>
        </td>
        <td class="is-right">
          <mu-icon fab value="editor">
          </mu-icon>
        </td>
        <td></td>
      </template>
    </mu-data-table>
  </mu-container>
</template>

<script>
  import userApi from './userApi.js';
  import userStore from './userVuex.js';

  export default {
    name: "userList",
    data() {
      return {
        selects: [],
        sort: {
          name: '',
          order: 'asc'
        },
        loading: true,
        columns: [
          {title: '编号', name: 'id', width: 64, align: 'center', sortable: true},
          {title: '用户昵称', name: 'nick_name', width: 128, align: 'center', sortable: true},
          {title: '管理员', name: 'isAdmin', width: 96, align: 'center', sortable: true},
          {title: '注册时间', name: 'create_time', width: 200, align: 'center', sortable: true},
          {title: '账户可用', name: 'isActive', width: 96, align: 'center', sortable: true},
          {title: '操作', name: 'controller', align: 'center'},
          {title: '', width: 96, name: '', align: ''},
        ],
        userList: []
      }
    },
    mounted() {
      // this.$store.registerModule("userStore", userStore);
      //  挂在时候开始获取数据
      userApi.getUserList();
    },
    methods: {
      handleSortChange({name, order}) {
        this.userList = this.userList.sort((a, b) => order === 'asc' ? a[name] - b[name] : b[name] - a[name]);
      }
    },
    computed: {
      handlerUserList: function () {
        return this.$store.getters.getUsers;
      }
    },
    watch: {
      handlerUserList: function (v, ov) {
        this.userList = v;
        if (v !== ov) {
          this.loading = false;
        }
      },
      removeSelect(selectIndex) {
        const index = this.selects.indexOf(selectIndex);
        this.selects.splice(index, 1);
      }
    },
    components: {
      // 'com-bread-crumbs': () => import('@/pages/admin/components/breadcrumbs'),
    }
  };
</script>
<style scoped>
</style>

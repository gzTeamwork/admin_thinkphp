<template>
  <mu-container>
    <mu-flex>
      <h2>Today</h2>
      <mu-flex fill align-items="center" justify-content="end">
        <mu-button icon @click="newRoleShow=true">
          <mu-icon value="loupe"></mu-icon>
        </mu-button>
        <mu-button icon @click="dataRefresh">
          <mu-icon value="refresh">刷新</mu-icon>
        </mu-button>
      </mu-flex>
    </mu-flex>
    <mu-paper :z-depth="1">
      <mu-data-table selectable select-all checkbox :loading="false" :columns="columns" :selects.sync="selects" checkbox
                     :sort.sync="sort" @sort-change="handleSortChange"
                     :data="roleList.slice(0, 6)">
        <template slot-scope="scope">
          <td class="is-center">{{scope.row.id}}</td>
          <td>{{scope.row.label}}</td>
          <td>{{scope.row.name}}</td>
          <td>{{scope.row.create_time}}</td>
          <td class="is-center">
            <mu-icon color="green300" v-if="scope.row.isActive" value="check_circle"></mu-icon>
            <mu-icon color="red300" v-else="scope.row.isActive" value="highlight_off"></mu-icon>
          </td>
        </template>
      </mu-data-table>
    </mu-paper>

    <com-role-new-dialog v-bind:openAlert="newRoleShow" v-on:openAlert="newRoleShow = false"></com-role-new-dialog>
  </mu-container>
</template>

<script>
  import userApi from './userApi.js';

  export default {
    name: "roleList",
    data() {
      return {
        selects: [],
        sort: {
          name: 'id',
          order: 'asc'
        },
        columns: [
          {title: '编号', name: 'id', width: 64, align: 'center', sortable: true},
          {title: '角色名', name: 'label', width: 220, sortable: true},
          {title: '角色标签', name: 'name', width: 160, sortable: true},
          {title: '创建时间', name: 'create_time', width: 200, sortable: true},
          {title: '是否可用', name: 'isActive', align: 'center', width: 100, sortable: true},
          {title: '权限', name: 'value', sortable: true},
        ],
        roleList: [],
        newRoleShow: false,
      }
    },
    mounted() {
      // this.$store.registerModule("userStore", userStore);
      //  挂在时候开始获取数据
      userApi.getRoleList();
    },
    methods: {
      handleSortChange({name, order}) {
        this.roleList = this.roleList.sort((a, b) => order === 'asc' ? a[name] - b[name] : b[name] - a[name]);
      },
      dataRefresh() {
        // 刷新数据
        userApi.getRoleList();
      }
    },
    computed: {
      handlerUserList: function () {
        return this.$store.getters.getRoles;
      }
    },
    watch: {
      handlerUserList: function (v) {
        this.roleList = v;
      },
      removeSelect(selectIndex) {
        const index = this.selects.indexOf(selectIndex);
        this.selects.splice(index, 1);
      }
    },
    components: {
      // 'com-bread-crumbs': () => import('@/pages/admin/components/breadcrumbs'),
      'com-role-new-dialog': () => import('./roleNewDialog'),
    }
  }
</script>

<style scoped>

</style>

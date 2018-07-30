<template>
  <section>
    <h2>栏目列表</h2>

    <!--文章数据表格-->
    <com-data-table ref="cateDatatTable" :datas="handlerCateList" :columns="cateColumns" addBtn>
      <!--表单内容-->
      <template slot="table" slot-scope="item">
        <td class="is-center">{{item.data.id}}</td>
        <td>{{item.data.title}}</td>
        <td>{{item.data.pid}}</td>
        <td>{{item.data.create_time}}</td>
        <td class="is-center">
          <mu-icon color="green300" v-if="item.data.is_active" value="check_circle"></mu-icon>
          <mu-icon color="red300" v-else="item.data.is_active" value="highlight_off"></mu-icon>
        </td>
        <td>
          <mu-button icon small color="red400" @click="eventRemoveCate(item.data)">
            <mu-icon value="close"></mu-icon>
          </mu-button>
        </td>
      </template>

      <!--新增素材-->
      <template slot="newDialog">
        <h3>新增栏目</h3>
        <com-cate-new></com-cate-new>
      </template>

    </com-data-table>
  </section>
</template>

<script>
  import cateApi from './cateApi';

  export default {
    name: "cateList",
    data() {
      return {
        cateList: [],
        cateColumns: [
          {title: '编号', name: 'id', width: 128, align: 'center', sortable: true},
          {title: '栏目标题', name: 'title', width: 220, sortable: true},
          {title: '父辈栏目', name: 'pid', width: 160, sortable: true},
          {title: '创建时间', name: 'create_time', width: 300, sortable: true},
          {title: '是否可用', name: 'is_active', align: 'center', width: 100, sortable: true},
          {title: '快捷操作'}
        ],
      }
    },
    methods: {
      eventRemoveCate: function (item) {
        // confirm('是否执行删除' + item.title + '栏目') ? this.$refs.cateDatatTable.eventRemoveData(item) : '';
        if (confirm('是否执行删除' + item.title + '栏目')) {
          if (item.id === 0) {
            alert('根目录是不能删除的');
            return false;
          } else {
            cateApi.setCateDel(item);
          }
        }
      }
    },
    mounted() {
      cateApi.getCateList();
    },
    components: {
      'com-cate-new': () => import('./cateNew'),
      'com-data-table': () => import('@/pages/admin/components/normalDatatable'),
    }
    ,
    computed: {
      handlerCateList: function () {
        return this.$store.getters.getCateList;
      }
    }
    ,
    watch: {
      handlerCateList: function (v, ov) {

        this.cateList = v;
      }
    },

  }
</script>

<style scoped>

</style>

<template>
  <section>
    <h2>栏目列表</h2>
    <!--弹窗区-->
    <mu-dialog width="860" transition="slide-bottom" scrollable overlay-close :open.sync="newCate.show" :title="'增加栏目'"
    >
      <com-cate-new></com-cate-new>
    </mu-dialog>
    <mu-flex align-items="end">
      <!--新增栏目-->
      <mu-button @click="eventNewCate">添加</mu-button>
    </mu-flex>
    <br>
    <mu-data-table fill selectable select-all checkbox :loading="false" :columns="columns" :selects.sync="selects"
                   checkbox
                   :sort.sync="sort" @sort-change="handleSortChange"
                   :data="cateList.slice((page.current-1)*page.perPageNum,page.current*page.perPageNum)">
      <template slot-scope="scope">
        <td class="is-center">{{scope.row.id}}</td>
        <td>{{scope.row.title}}</td>
        <td>{{scope.row.pid}}</td>
        <td>{{scope.row.create_time}}</td>
        <td class="is-center">
          <mu-icon color="green300" v-if="scope.row.is_active" value="check_circle"></mu-icon>
          <mu-icon color="red300" v-else="scope.row.is_active" value="highlight_off"></mu-icon>
        </td>
        <td>

          <!--编辑文章-->
          <mu-button icon @click="handlerPostsEdit(scope.row)">
            <mu-icon value="edit"></mu-icon>
          </mu-button>
          <!--删除文章-->
          <mu-button icon color="red300" @click="handlerPostsEdit(scope.row)">
            <mu-icon value="close"></mu-icon>
          </mu-button>

        </td>
      </template>
    </mu-data-table>

    <mu-flex justify-content="center" style="margin: 32px 0;">
      <mu-pagination raised :total="cateList.length" :pageSize="page.perPageNum" :current.sync="page.current"
                     @change="handlerListChange">
      </mu-pagination>
    </mu-flex>


  </section>
</template>

<script>
  import cateApi from './cateApi';

  export default {
    name: "cateList",
    data() {
      return {
        newCate: {
          show: false,
        },
        cateEdit: {
          show: false,
          cate: {}
        },
        cateList: [],
        selects: [],
        sort: {
          name: 'id',
          order: 'asc'
        },
        loading: true,
        page: {
          current: 1,
          perPageNum: 15,
        },
        columns: [
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
      eventNewCate() {
        this.newCate.show = true;
      },
      handleSortChange({name, order}) {
        this.cateList = this.cateList.sort((a, b) => order === 'asc' ? a[name] - b[name] : b[name] - a[name]);
      },
      handlerListChange(v) {
        console.log(v);
      },
    },
    mounted() {
      cateApi.getCateList();
    },
    components: {
      'com-cate-new':
        () => import('./cateNew'),
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
    }
  }
</script>

<style scoped>

</style>

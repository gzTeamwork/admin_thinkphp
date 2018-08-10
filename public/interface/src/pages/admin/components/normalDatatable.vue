<template>
  <section>
    <mu-button v-if="addBtn" icon @click="eventPopNewDialog">
      <mu-icon value="exposure_plus_1"></mu-icon>
    </mu-button>
    <!--通用型表格插件 - museui - datetable-->
    <mu-data-table fill selectable select-all checkbox fit
                   :loading="false"
                   :columns="columns"
                   :rowKey="'rowKey'"
                   :selects.sync="selects"
                   :sort.sync="sort" @sort-change="handleSortChange"
                   :data="dataList.slice((page.current-1)*page.perPageNum,page.current*page.perPageNum)">
      <template slot-scope="scope">
        <slot name="table" :data="scope.row"></slot>
        <!--<td>-->
        <!--&lt;!&ndash;预览单项&ndash;&gt;-->
        <!--<mu-button icon @click="handlerPostsView(scope.row)">-->
        <!--<mu-icon value="remove_red_eye"></mu-icon>-->
        <!--</mu-button>-->
        <!--&lt;!&ndash;编辑单项&ndash;&gt;-->
        <!--&lt;!&ndash;<mu-button icon @click="handlerPostsEdit(scope.row)">&ndash;&gt;-->
        <!--<mu-button icon :to="'/admin/post/publish?id='+scope.row.id">-->
        <!--<mu-icon value="edit"></mu-icon>-->
        <!--</mu-button>-->
        <!--&lt;!&ndash;删除单项&ndash;&gt;-->
        <!--<mu-button icon color="red300" @click="eventRemoveItem(scope.row.data)">-->
        <!--<mu-icon value="close"></mu-icon>-->
        <!--</mu-button>-->

        <!--</td>-->
      </template>
    </mu-data-table>
    <!--页码-->
    <mu-flex justify-content="center" style="margin: 32px 0;">
      <mu-pagination raised :total="dataList.length" :pageSize="page.perPageNum" :current.sync="page.current"
                     @change="handlerListChange">
      </mu-pagination>
    </mu-flex>

    <!--新增弹框单项-->
    <mu-dialog :open.sync="popNewData.show" width="860" transition="slide-bottom" scrollable overlay-close>
      <mu-button style="float: right;" icon @click="popNewData.show=false">
        <mu-icon value="close"></mu-icon>
      </mu-button>
      <slot name="newDialog" :data="popNewData.datas">
      </slot>
    </mu-dialog>


    <!--修改弹框单项-->
    <mu-dialog :open.sync="popEditData.show" width="860" transition="slide-bottom" scrollable overlay-close>
      <mu-button style="float: right;" icon @click="popEditData.show=false">
        <mu-icon value="close"></mu-icon>
      </mu-button>
      <slot name="editDialog" :data="popEditData.datas">
      </slot>
    </mu-dialog>

    <!--预览弹框单项-->
    <mu-dialog :open.sync="popViewData.show" width="860" transition="slide-bottom" scrollabel overlay-close>
      <mu-button style="float: right;" fab @click="popViewData.show=false">
        <mu-icon value="close"></mu-icon>
      </mu-button>
      <slot name="viewDialog" :data="popViewData.datas">
      </slot>
    </mu-dialog>

  </section>
</template>

<script>
  export default {
    name: "normalDatatable",
    props: {
      datas: {
        type: Array,
        default: () => {
          return [];
        }
      },
      addBtn: {type: Boolean, default: false},
      columns: {
        type: Array,
        default: () => {
          return [];
        }
      },
      itemTool: {type: Boolean, default: false},
      order: {
        type: String, default: () => {
          return 'id';
        }
      }
    },
    data() {
      return {
        popEditData: {
          show: false,
          datas: {}
        },
        popNewData: {
          show: false,
          datas: {}
        },
        popViewData: {
          show: false,
          data: {}
        },
        dataList: [],
        selects: [],
        sort: {
          name: this.order,
          order: 'asc'
        },
        loading: true,
        page: {
          current: 1,
          perPageNum: 15,
        },
        // columns: [
        //   {title: '编号', name: 'id', width: 128, align: 'center', sortable: true},
        //   {title: '文章标题', name: 'title', width: 220, sortable: true},
        //   {title: '类型', name: 'kind', width: 120, sortable: true},
        //   {title: '作者', name: 'author', width: 160, sortable: true},
        //   {title: '创建时间', name: 'create_time', width: 300, sortable: true},
        //   {title: '是否可用', name: 'is_active', align: 'center', width: 100, sortable: true},
        //   {title: '快捷操作'}
        // ],
      }
    }, methods: {
      handleSortChange({name, order}) {
        this.dataList = this.dataList.sort((a, b) => order === 'asc' ? a[name] - b[name] : b[name] - a[name]);
      },
      handlerListChange(v) {
        // console.log(v);
      },
      eventPopNewDialog() {
        this.popNewData.show = true;
      },

    }, watch: {
      datas: function (v) {
        this.dataList = [...v];
      }
    }, mounted() {

    }
  }
</script>

<style lang="scss" scoped>
</style>

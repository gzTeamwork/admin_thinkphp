<template>
  <mu-container>
    <mu-sub-header>单元预约 共{{dataList.length}}个</mu-sub-header>
    <com-data-table ref="datatTable" order="order_date" :datas.sync="dataList" :columns="dataColumns">
      <template slot="table" slot-scope="item">
        <td class="is-center">{{item.data.id}}</td>
        <td>{{item.data.order_kind}}</td>
        <td>{{item.data.order_date}}</td>
        <td>{{item.data.order_name}}</td>
        <td>{{item.data.order_tel}}</td>
        <td>{{item.data.order_company}}</td>
        <td>{{item.data.order_id}}</td>
        <td>
          <mu-button icon small color="red400" @click="eventRemoveCate(item.data)">
            <mu-icon value="close"></mu-icon>
          </mu-button>
        </td>
      </template>
    </com-data-table>
  </mu-container>
</template>

<script>
  import orderApi from './orderApi';

  export default {
    name: "orderBooking",
    components: {
      comDataTable: () => import('@/pages/admin/components/normalDatatable'),
    }, data() {
      return {
        dataList: [],
        dataColumns: [
          {title: '编号', name: 'id', width: 128, align: 'center', sortable: true},
          {title: '预约分类', name: 'order_kind', sortable: true},
          {title: '预约日期', name: 'order_date', sortable: true},
          {title: '姓名', name: 'order_name', sortable: true},
          {title: '电话', name: 'order_tel', sortable: true},
          {title: '公司', name: 'order_company'},
          {title: '预约单元', name: 'order_id'},
          {title: '快捷操作'}
        ],
      }
    },
    mounted() {
      new Promise(resolve => {
        let res = orderApi.getBookings();
        resolve(res)
      }).then(res => {
        this.dataList = res
      })
    }
    , methods: {
      eventRemoveCate(data) {
        console.info('删除栏目', data);
      }
    }
  }
</script>

<style scoped>

</style>

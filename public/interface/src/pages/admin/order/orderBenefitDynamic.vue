<template>
  <mu-container>
    <mu-sub-header>公益留言 共{{dataList.length}}个</mu-sub-header>
    <com-data-table ref="datatTable" order="order_date" :datas.sync="dataList" :columns="dataColumns">
      <template slot="table" slot-scope="item">
        <td class="is-center">{{item.data.id}}</td>
        <td>{{item.data.name}}</td>
        <td>{{item.data.content}}</td>
        <td>{{item.data.create_time}}</td>
        <td>{{item.data.tel}}</td>
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
  import orderApi from './orderApi'

  export default {
    name: "orderBenefitDynamic",
    components: {
      comDataTable: () => import('@/pages/admin/components/normalDatatable'),
    }, data() {
      return {
        dataList: [],
        dataColumns: [
          {title: '编号', name: 'id', width: 128, align: 'center', sortable: true},
          {title: '留言人姓名', name: 'name', sortable: true},
          {title: '留言内容', name: 'content', sortable: true},
          {title: '留言时间', name: 'create_time', sortable: true},
          {title: '电话', name: 'tel', sortable: true},
          {title: '快捷操作'}
        ],
      }
    },
    mounted() {
      new Promise(resolve => {
        let res = orderApi.getBenefitDynamic();
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

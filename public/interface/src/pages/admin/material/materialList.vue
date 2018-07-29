<template>
  <section class="mu-container">
    <h3>素材
      <small>material</small>
      <mu-switch v-model="tableView"></mu-switch>
      视图
    </h3>
    <mu-sub-header>{{tableView?'数据表格':'文件视图'}}</mu-sub-header>
    <!--文章数据表格-->
    <com-data-table v-if="tableView" :datas="handlerGetMaterials" :colums="materialsColumns">
      <!--表单内容-->
      <template slot="table" slot-scope="material">
        <td>
          {{material.data.id}}
        </td>
        <td>{{material.data.title}}</td>
        <td>{{material.data.type}}</td>
        <td>{{material.data.author}}</td>
        <td>{{material.data.create_time}}</td>
        <td class="is-center">
          <mu-icon color="green300" v-if="material.data.is_active" value="check_circle"></mu-icon>
          <mu-icon color="red300" v-else="material.data.is_active" value="highlight_off"></mu-icon>
        </td>
      </template>

      <!--新增素材-->
      <template slot="newDialog">
        <com-uploader ></com-uploader>
      </template>

    </com-data-table>

    <mu-row v-else :cols="12" :padding="20" :cell-height="120" gutter>
      <mu-col :span="2" v-for="(e,i) in handlerGetMaterials" :key="i">
        <mu-button fab>
          {{e.type}}
        </mu-button>
        <br>
        <small>{{e.title}}</small>
      </mu-col>
    </mu-row>
  </section>
</template>

<script>
  import materialApi from './materialApi'

  export default {
    name: "materialList",
    components: {
      'com-data-table': () => import('@/pages/admin/components/normalDatatable'),
      // 'com-uploader': () => import('@/pages/components/Uploader'),
      'com-uploader': () => import('@/pages/admin/uploader/uploader'),
    },
    data() {
      return {
        uploadFiles: [],
        tableView: true,
        materialList: [],
        materialsColumns: [
          {title: '编号', name: 'id', width: 128, align: 'center', sortable: true},
          {title: '文章标题', name: 'title', width: 220, sortable: true},
          {title: '类型', name: 'kind', width: 120, sortable: true},
          {title: '作者', name: 'author', width: 160, sortable: true},
          {title: '创建时间', name: 'create_time', width: 300, sortable: true},
          {title: '是否可用', name: 'is_active', align: 'center', width: 100, sortable: true},
          {title: '快捷操作'}
        ]
      }
    }
    ,
    mounted() {
      let vm = this;
      materialApi.getMaterial();
    }
    ,
    computed: {
      handlerGetMaterials: function () {
        return this.$store.getters.getMaterials;
      }
    }
    ,
    watch: {
      handlerGetMaterials: function (v) {
        this.materialList = v;
      }
    }
    ,
  }
</script>

<style scoped>

</style>

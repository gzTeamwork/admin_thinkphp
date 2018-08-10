<template>
  <section class="mu-container">
    <mu-linear-progress v-if="loading"></mu-linear-progress>
    <mu-sub-header>文章列表</mu-sub-header>
    <mu-row style="margin: 1em;" gutter fill>

      <mu-col :span="4">
        <mu-button :to="'/admin/post/publish'">
          <mu-icon value="plus_one"></mu-icon>
          发布新文章
        </mu-button>
        <mu-button @click="eventClearFilter" :to="'#'">
          <mu-icon value="layers_clear"></mu-icon>
          清除筛选
        </mu-button>
      </mu-col>

      <mu-col :span="4">
        <small>标题搜索</small>
        <mu-text-field position="left" v-model="filterable.postTitle">
        </mu-text-field>
        <mu-button icon small @click="eventPostTitleSearch">
          <mu-icon value="search"></mu-icon>
        </mu-button>
      </mu-col>

      <mu-col :span="4">
        <small>文章类型</small>
        <mu-select v-model="filterable.postKindSearch" @change="eventPostKindChange">
          <mu-option v-for="option,index in postKinds" :key="option.name" :label="option.title"
                     :value="option.name"></mu-option>
        </mu-select>
      </mu-col>
    </mu-row>

    <!--文章数据表格-->
    <com-data-table ref="postDataTable" :datas.sync="postList" :columns="postColumns">
      <!--表单内容-->
      <template slot="table" slot-scope="item">
        <td class="is-center">{{item.data.id}}</td>
        <td>{{item.data.title}}</td>
        <td>{{item.data.kind}}</td>
        <td>{{item.data.create_time}}</td>
        <td class="is-center">
          <mu-icon color="green300" v-if="item.data.is_active" value="check_circle"></mu-icon>
          <mu-icon color="red300" v-else="item.data.is_active" value="highlight_off"></mu-icon>
        </td>
        <td>
          <!--预览文章-->
          <mu-button icon small :to="'#view'" @click="eventPreView(item.data)">
            <mu-icon value="remove_red_eye"></mu-icon>
          </mu-button>
          <!--编辑文章-->
          <mu-button icon small :to="'/admin/post/publish?id='+ item.data.id">
            <mu-icon value="edit"></mu-icon>
          </mu-button>
          <!--删除文章-->
          <mu-button icon small :to="'#del'" color="red400" @click="eventRemove(item.data)">
            <mu-icon value="close"></mu-icon>
          </mu-button>
        </td>
      </template>

      <!--新增栏目-->
      <template slot="newDialog">
        <h3>新增栏目</h3>
        <com-editor :content="postNew.post.content"></com-editor>
      </template>

      <template slot="editDialog">
        <h3>编辑文章</h3>
        <com-editor :content="postNew.post.content"></com-editor>
      </template>

    </com-data-table>

  </section>
</template>

<script>
  import postApi from './postApi';
  export default {
    name: "postList",
    components: {
      comEditor: () => import('vue-tinymce-editor'),
      comDataTable: () => import('@/pages/admin/components/normalDatatable'),
      comProgressBar: () => import('@/pages/components/progressBar'),
    },
    data() {
      return {
        postNew: {
          show: false,
          post:
            {}
        },
        postList: [],
        postKinds:
          [
            {title: '文章', name: 'post', content: []},
          ],
        postColumns:
          [
            {title: '编号', name: 'id', width: 128, align: 'center', sortable: true},
            {title: '文章标题', name: 'title', width: 220, sortable: true},
            {title: '类型', name: 'kind', sortable: true},
            {title: '创建时间', name: 'create_time', width: 300, sortable: true},
            {title: '是否可用', name: 'is_active', align: 'center', width: 100, sortable: true},
            {title: '快捷操作'}
          ],
        //  搜索框值
        filterable:
          {
            cateSearch: '根目录',
            postKindSearch:
              '文章',
            postTitle:
              '',
          }
        ,
        //  搜索状态
        tableFiltered: false,
        loading: true,
      }
    },
    computed: {
      //  获取postStore.getPosts
      handlerPosts: function () {
        return this.$store.getters.getPosts;
      },
      //  获取cateStore.getCateList
      handlerCateList: function () {
        return this.$store.getters.getCateList;
      },
      //  获取数据模板
      handlerPostTemplateList: function () {
        return this.$store.getters.getPostTemplates;
      },
    },
    watch: {
      handlerPosts: function (v, ov) {
        if (v !== ov) {
          this.loading = false;
        }
        v.map(e => {
          let res = this.$_.findIndex(this.postKinds, {name: e.kind});
          console.log(res,);
        });
        this.postList = [...v];
      },
      handlerPostTemplateList: function (v) {
        this.postKinds = this.postKinds.slice(0, 1).concat(v);
      },
    },
    methods: {
      //  查看
      eventPreView: function (item) {

      },
      //  删除事件
      eventRemove: function (item) {
        let vm = this;
        if (confirm('是否执行删除[' + item.title + ']文章')) {
          new Promise(resolve => {
            let res = postApi.setPostDel(item);
            resolve(res)
          }).then(res => {
            if (res === 1) {
              //  去掉对应文章
              vm.postList.splice(vm.postList.indexOf(item), 1);
            }
          })
        }
      },
      //  筛选文章分类
      eventPostKindChange: function (v) {
        if (v === 'post') {
          this.postList = [...this.handlerPosts];
        } else {
          let filterPostList = [];
          this.postList.map((e, i) => {
            e.kind === v ? filterPostList.push(e) : '';
          })
          this.postList = [...filterPostList];
        }
        this.tableFiltered = true;
      },
      //  筛选文章标题
      eventPostTitleSearch: function () {
        let searchWord = this.filterable.postTitle;
        if (searchWord === null && searchWord === '') {
          return;
        }
        let filterPostList = [];
        this.handlerPosts.map((e, i) => {
          //  不分大小写筛选
          e.title.match(new RegExp(searchWord, 'i')) ? filterPostList.push(e) : '';
        });
        this.postList = [...filterPostList];
        this.tableFiltered = true;
      },
      //  清除文章筛选
      eventClearFilter: function () {
        this.filterable.postTitle = '';
        this.filterable.postKindSearch = '文章';
        this.postList = [...this.handlerPosts];
      }
    },
    mounted() {
      let vm = this;
      postApi.getPosts({perPage: 200}).then(function () {
        vm.loading = false;
        postApi.getPostTemplates();
      })
    }
  }
</script>

<style scoped>

</style>

<template>
  <section class="mu-container">
    <mu-sub-header>文章列表</mu-sub-header>
    <!--文章数据表格-->
    <com-data-table ref="postDatatTable" :datas="handlerPosts" :columns="postColumns">
      <!--表单内容-->
      <template slot="table" slot-scope="item">
        <td class="is-center">{{item.data.id}}</td>
        <td>{{item.data.title}}</td>
        <td>{{item.data.kind}}</td>
        <td>{{item.data.author}}</td>
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

      <!--新增素材-->
      <template slot="newDialog">
        <h3>新增栏目</h3>
        <com-editor :content="postNew.post.content"></com-editor>
      </template>

      <template slot="editDialog">
        <h3>编辑文章</h3>
        <com-editor :content="postNew.post.content"></com-editor>
      </template>

    </com-data-table>


    <!--文章预览-->
    <!--<mu-dialog width="860" transition="slide-bottom" scrollable overlay-close :open.sync="newPost.show"-->
    <!--:title="'文章预览'"-->
    <!--&gt;-->
    <!--<mu-flex justify="center">-->
    <!--<img :src="newPost.post.thumb" alt="文章封面">-->
    <!--</mu-flex>-->
    <!--<h2>{{newPost.post.title}}</h2>-->
    <!--<small>-->
    <!--作者 {{newPost.post.author}} | 发表于 {{newPost.post.update_time}}-->
    <!--</small>-->
    <!--<p style="text-indent: 2em;" v-html="newPost.post.content"></p>-->
    <!--</mu-dialog>-->

  </section>
</template>

<script>
  import postApi from './postApi';

  export default {
    name: "postList",
    components: {
      'com-editor': () => import('vue-tinymce-editor'),
      'com-data-table': () => import('@/pages/admin/components/normalDatatable'),

    },
    data() {
      return {
        postNew: {
          show: false,
          post: {}
        },
        postList: [],
        postColumns: [
          {title: '编号', name: 'id', width: 128, align: 'center', sortable: true},
          {title: '文章标题', name: 'title', width: 220, sortable: true},
          {title: '类型', name: 'kind', width: 120, sortable: true},
          {title: '作者', name: 'author', width: 160, sortable: true},
          {title: '创建时间', name: 'create_time', width: 300, sortable: true},
          {title: '是否可用', name: 'is_active', align: 'center', width: 100, sortable: true},
          {title: '快捷操作'}
        ],
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
      }
    },
    watch: {
      handlerPosts: function (v, ov) {
        if (v !== ov) {
          this.loading = false;
        }
        this.postList = v;
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
          postApi.setPostDel(item);
          setTimeout(() => {
            postApi.getPosts()
          }, 1000);
        }
      },
    },
    mounted() {
      let vm = this;
      postApi.getPostsList();
    }
  }
</script>

<style scoped>

</style>
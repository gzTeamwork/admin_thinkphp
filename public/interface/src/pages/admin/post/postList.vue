<template>
  <section class="mu-container">
    <!--文章预览-->
    <mu-dialog width="860" transition="slide-bottom" scrollable overlay-close :open.sync="postView.show" :title="'文章预览'"
    >
      <mu-flex justify="center">
        <img :src="postView.post.thumb" alt="文章封面">
      </mu-flex>
      <h2>{{postView.post.title}}</h2>
      <small>
        作者 {{postView.post.author}} | 发表于 {{postView.post.update_time}}
      </small>
      <p style="text-indent: 2em;" v-html="postView.post.content"></p>
    </mu-dialog>

    <!--文章修改-->
    <mu-dialog width="860" transition="slide-bottom" scrollable overlay-close :open.sync="postEdit.show" :title="'文章预览'"
    >
      <mu-flex justify="center">
        <img :src="postEdit.post.thumb" alt="文章封面">
      </mu-flex>
      <h2>{{postEdit.post.title}}</h2>
      <small>
        作者 {{postEdit.post.author}} | 发表于 {{postEdit.post.update_time}}
      </small>
      <com-editor :value="postEdit.post.content"></com-editor>
    </mu-dialog>
    <!--<vue-editor editor="quill" :height="900"></vue-editor>-->
    <mu-data-table fill selectable select-all checkbox :loading="false" :columns="columns" :selects.sync="selects"
                   checkbox
                   :sort.sync="sort" @sort-change="handleSortChange"
                   :data="postList.slice((page.current-1)*page.perPageNum,page.current*page.perPageNum)">
      <template slot-scope="scope">
        <td class="is-center">{{scope.row.id}}</td>
        <td>{{scope.row.title}}</td>
        <td>{{scope.row.author}}</td>
        <td>{{scope.row.create_time}}</td>
        <td class="is-center">
          <mu-icon color="green300" v-if="scope.row.isActive" value="check_circle"></mu-icon>
          <mu-icon color="red300" v-else="scope.row.isActive" value="highlight_off"></mu-icon>
        </td>
        <td>

          <!--预览文章-->
          <mu-button icon @click="handlerPostsView(scope.row)">
            <mu-icon value="remove_red_eye"></mu-icon>
          </mu-button>
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
      <mu-pagination raised :total="postList.length" :pageSize="page.perPageNum" :current.sync="page.current"
                     @change="handlerListChange">

      </mu-pagination>
    </mu-flex>
  </section>
</template>

<script>
  import postApi from './postApi';

  export default {
    name: "postList",
    components: {
      // comEditor: () => import('@/pages/components/editor'),
      comEditor: () => import('@/pages/components/editor-tinymce'),
    },
    data() {
      return {
        postEdit: {
          show: false,
          post: {}
        },
        postView: {
          show: false,
          post: {}
        },
        postList: [],
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
          {title: '文章标题', name: 'title', width: 220, sortable: true},
          {title: '作者', name: 'author', width: 160, sortable: true},
          {title: '创建时间', name: 'create_time', width: 300, sortable: true},
          {title: '是否可用', name: 'isActive', align: 'center', width: 100, sortable: true},
          {title: '快捷操作'}
        ],
      }
    },
    computed: {
      handlerPosts: function () {
        return this.$store.getters.getPosts;
      }
    },
    watch: {
      handlerPosts: function (v, ov) {
        if (v !== ov) {
          this.loading = false;
        }
        this.postList = v;
      }
    },
    methods: {
      handleSortChange({name, order}) {
        this.postList = this.postList.sort((a, b) => order === 'asc' ? a[name] - b[name] : b[name] - a[name]);
      },
      handlerListChange(v) {
        console.log(v);
      },
      handlerPostsEdit(p) {
        this.postEdit.show = true;
        // console.log(pid);
        this.postEdit.post = p;
      },
      handlerPostsView(p) {
        this.postView.show = true;
        // console.log(pid);
        this.postView.post = p;
      }
    },
    mounted() {
      let vm = this;
      postApi.getPosts();
    }
  }
</script>

<style scoped>

</style>

<template>
  <section class="mu-container" style="background: white;" v-loading="loading">
    <mu-flex>
      <mu-flex grow="2" style="padding:2em">
        <mu-form :model="form" class="mu-demo-form" :label-position="'top'" @submit="'false'">
          <h3>基本信息</h3>
          <mu-form-item prop="input" icon="title" label="文章标题">
            <mu-text-field v-model="form.title"></mu-text-field>
          </mu-form-item>
          <mu-form-item prop="input" icon="menu" label="所属栏目">
            <mu-select filterable v-model="filterable.cateSearch" full-width @change="eventCateChange"
                       @click="eventCateGet">
              <mu-option v-for="(cate,index) in handlerCateList" :key="index" :label="cate.title"
                         :value="cate.id"></mu-option>
            </mu-select>
          </mu-form-item>
          <mu-form-item prop="input" icon="kind" label="文章类别">
            <mu-select filterable v-model="filterable.postKindSearch" full-width @change="eventPostKindChange">
              <mu-option v-for="(kind,index) in postKinds" :key="index" :label="kind.title"
                         :value="kind.name"></mu-option>
            </mu-select>
          </mu-form-item>
          <mu-form-item prop="input" icon="today" label="选择发布日期时间">
            <mu-date-input v-model="form.create_time" :format="'YYYY年MM月DD日 A HH:mm'" type="dateTime" full-width
                           landscape
                           actions></mu-date-input>
          </mu-form-item>
          <!--封面-->
          <mu-form-item prop="input" icon="thumb" label="封面图">
            <img v-if="form.thumb" :src="form.thumb" alt="封面图" width="400"/>
            <br>
            <com-admin-uploader
              v-on:getResult="eventPostThumbFinished($event)">
            </com-admin-uploader>
          </mu-form-item>

          <!--内容-->
          <mu-form-item prop="input" icon="content" label="内容">
            <com-vue-mce v-if="!loading" id="postTinymce" v-model.sync="form.content" :other_options="tinymceInit"
                         class="full-width" ref="tinymceEditor"></com-vue-mce>
          </mu-form-item>

        </mu-form>
      </mu-flex>
      <mu-flex style="padding:2em">
        <com-post-extra v-if="form.extraList.length > 1" :extraList.sync="form.extraList">
        </com-post-extra>
      </mu-flex>
    </mu-flex>
    <mu-flex class="cms-stick">
      <div class="bar bottom black">
        <mu-button v-if="$route.query.id" @click="eventPostPublishSubmit">
          更新文章
        </mu-button>
        <mu-button v-else primary @click="eventPostPublishSubmit">
          提交发布
        </mu-button>
      </div>
    </mu-flex>

  </section>
</template>

<script>
  import adminUploader from '@/pages/admin/uploader/uploader';
  import cateApi from '@/pages/admin/category/cateApi';
  import postApi from "./postApi";
  import uploaderApi from "../uploader/uploaderApi";

  export default {
    name: "postPublish",
    components: {
      'com-post-extra': () => import('./postExtra'),
      'com-vue-mce': () => import('vue-tinymce-editor'),
      'com-admin-uploader': adminUploader,
    },
    data() {
      return {
        loading: true,
        form: {
          kind: 'post',
          content: '',
          category: 0,
          create_time: new Date(),
          extraList: [],
          thumb: null,
        },
        postThumb: {},
        postKinds: [
          {title: '文章', name: 'post', content: []},
        ],
        picker: {
          create_time: {
            show: false,
          }
        },
        //  搜索框值
        filterable: {
          cateSearch: '根目录',
          postKindSearch: '文章',
        },
        tinymceInit: {
          language_url: '/static/tinymce/zh_CN.js',
          language: 'zh_CN',
          skin_url: '/static/tinymce/skins/lightgray',
          height: 600,
          // external_plugins: {
          //   'imageSelector': '/static/tinymce/plugins/imageSelector.js',
          // },
          // plugins: 'link lists image code table colorpicker textcolor wordcount contextmenu imageSelector',
          plugins: 'link lists image code table colorpicker textcolor wordcount contextmenu',
          // toolbar1:
          //   'bold italic underline strikethrough | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | undo redo | link unlink image code | removeformat | imageSelector',
          toolbar1:
            'bold italic underline strikethrough | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | undo redo | link unlink image code | removeformat |',
          branding: true,
          // imageSelectorCallback: this.eventEditorUpload,
          //上传图片回调
          images_upload_handler: async function (blobInfo, success, failure) {
            let file = await uploaderApi.uploadImg(blobInfo.blob());
            success(file.thumb);
          }
        }
      }
    },
    mounted() {
      let vm = this
      new Promise((next) => {
        cateApi.getCateList();
        postApi.getPostTemplates();
        let id = vm.$route.query.id || false;
        if (id !== false) {
          // 修改模式
          let post = postApi.getPost({id: id});
        }
        next();

      }).then(post => {
        vm.loading = false
      })
    }
    ,
    computed: {
      //  获取栏目列表
      handlerCateList: function () {
        return this.$store.getters.getCateList;
      }
      ,
      //  获取数据模板
      handlerPostTemplateList: function () {
        return this.$store.getters.getPostTemplates;
      }
      ,
      //  获取当前文章 - 有id的话
      handlerPostCurrent: function () {
        return this.$store.getters.getPostCurrent;
      }
    }
    ,
    watch: {
      handlerPostTemplateList: function (v) {
        this.postKinds = this.postKinds.slice(0, 1).concat(v);
        // if (this.$route.query.id) {
        //   this.eventPostKindChange(this.form.kind, [...this.form.post_extra]);
        // }
      }
      ,
      handlerPostCurrent: function (v) {
        this.form = v;
        this.eventCateChange(this.form.category);
        this.filterable.postKindSearch = this.form.kind;
        this.eventPostKindChange(this.form.kind, [...this.form.post_extra]);
      }
    }
    ,
    methods: {
      eventCateGet: function (v) {
        console.log(v)
      }
      ,
      eventCateChange: function (v) {
        this.form.category = v;
        this.filterable.cateSearch = v;
      }
      ,
      //  切换文章类别 - 切换附加数据的模板
      eventPostKindChange: function (v, exlist) {
        this.form.kind = v
        this.postKinds.map((e, i) => {
          if (e.name === v) {
            console.log(e);
            this.form.extraList = exlist || e.content;
          }
        })

      }
      ,
      // post thumb uploading
      eventPostThumbFinished: function (v) {
        console.info("文章封面上传完毕", v);
        this.postThumb = v;
        this.form.thumb = this.postThumb.thumb;
      },
      //  提交发布文章
      eventPostPublishSubmit: function () {
        let vm = this;
        let postForm = {...this.form};
        // console.log(postForm.create_time);
        postForm.create_time = postForm.create_time.hasOwnProperty('getTime') ? parseInt(postForm.create_time.getTime() / 1000) : postForm.create_time;
        new Promise(resolve => {
          let res = postApi.setPost(postForm);
          resolve(res)
        }).then(res => {
          window.$toast.info(res.msg);
          // vm.$router.push('/admin/post/list');
        })
      },
      //  提交修改上传图片
      eventEditorUpload: function (e) {
        let vm = this;
        console.log(e());
        new Promise((resolve, reject) => {
          vm.$refs.editorUploader.eventSelectFile();
          resolve(vm.$store.getters.getUploadFile);
        }).then((file) => {
            // console.info(vm);
            // editor.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' + r + '"/>');
            // console.info(file);
          }
        )
        ;
      }
    }
  }


</script>

<style lang="scss" scoped>

</style>

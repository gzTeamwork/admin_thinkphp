<template>
  <section class="mu-container" style="background: white;">
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
          <mu-form-item prop="input" icon="thumb" label="封面图">
            <com-admin-uploader v-on:getResult="eventPostThumbFinished"></com-admin-uploader>
          </mu-form-item>
          <mu-form-item prop="input" icon="content" label="内容">
            <com-admin-uploader></com-admin-uploader>
            <!--<com-editor v-model:content="form.content"></com-editor>-->
            <com-vue-mce id="postTinymce" v-model="form.content" :other_options="tinymceInit"
                         class="full-width" ref="tinymceEditor"></com-vue-mce>
          </mu-form-item>
          <mu-button v-if="$route.query.id" @click="eventPostPublishSubmit">
            更新文章
          </mu-button>
          <mu-button v-else primary @click="eventPostPublishSubmit">
            提交发布
          </mu-button>
        </mu-form>
      </mu-flex>
      <mu-flex style="padding:2em">
        <com-post-extra v-if="form.extraList.length>1" :extraList.sync="form.extraList"></com-post-extra>
      </mu-flex>
    </mu-flex>

  </section>
</template>

<script>
  import adminUploader from '@/pages/admin/uploader/uploader';
  import cateApi from '@/pages/admin/category/cateApi';
  import postApi from "./postApi";

  export default {
    name: "postPublish",
    components: {
      // 'com-uploader': () => import('@/pages/components/uploader/uploader'),
      'com-post-extra': () => import('./postExtra'),
      'com-vue-mce': () => import('vue-tinymce-editor'),
      'com-admin-uploader': adminUploader,
    },
    data() {
      return {
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
          external_plugins: {
            'imageSelector': '/static/tinymce/plugins/imageSelector.js',
          },
          plugins: 'link lists image code table colorpicker textcolor wordcount contextmenu imageSelector',
          toolbar1:
            'bold italic underline strikethrough | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | undo redo | link unlink image code | removeformat | imageSelector',
          branding: true,
          imageSelectorCallback: (cb) => {
            cb('dfas');
          },  // 点击编辑器上的图片按钮后的回调方法

        }
      }
    },
    mounted() {
      cateApi.getCateList();
      postApi.getPostTemplates();
      let id = this.$route.query.id || false;
      if (id !== false) {
        // 修改模式
        postApi.getPost({id: id});
      }
      // this.$refs.tinymce.PluginManager.add('imageSelector', function (editor, url) {
      //   // Add a button that opens a window
      //   editor.addButton('imageSelector', {
      //     icon: 'image',
      //     tooltip: "select image from image lib",
      //     onclick: function () {
      //       editor.settings.imageSelectorCallback(function (r) {
      //         console.log('inserting image to editor: ' + r);
      //         editor.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' + r + '"/>');
      //       });
      //     }
      //   });
      // });
    },
    computed: {
      //  获取栏目列表
      handlerCateList: function () {
        return this.$store.getters.getCateList;
      },
      //  获取数据模板
      handlerPostTemplateList: function () {
        return this.$store.getters.getPostTemplates;
      },
      //  获取当前文章 - 有id的话
      handlerPostCurrent: function () {
        return this.$store.getters.getPostCurrent;
      }
    },
    watch: {
      handlerPostTemplateList: function (v) {
        this.postKinds = this.postKinds.slice(0, 1).concat(v);
        if (this.$route.query.id) {
          this.eventPostKindChange(this.form.kind, [...this.form.post_extra]);
        }
      },
      handlerPostCurrent: function (v) {
        this.form = v;
        this.eventCateChange(this.form.category);
        this.filterable.postKindSearch = this.form.kind;
        this.eventPostKindChange(this.form.kind, [...this.form.post_extra]);
      }
    },
    methods: {
      eventCateGet: function (v) {
        console.log(v)
      },
      eventCateChange: function (v) {
        this.form.category = v;
        this.filterable.cateSearch = v;
      },
      //  切换文章类别 - 切换附加数据的模板
      eventPostKindChange: function (v, exlist) {
        // this.form.kind = v
        this.postKinds.map((e, i) => {
          if (e.name == v) {
            console.log(e);
            this.form.extraList = exlist || e.content;
          }
        })

      },
      // post thumb uploaded
      eventPostThumbFinished: function (v) {
        console.info("文章封面上传完毕", v);
        this.postThumb = v;
        this.form.thumb = this.postThumb.thumb;
      },
      eventPostPublishSubmit: function () {
        let postForm = {...this.form};
        console.log(postForm.create_time);
        postForm.create_time = parseInt(postForm.create_time.getTime() / 1000);
        postApi.setPost(postForm);
      },
      showImageSelector: function (cb) {
        console.log('被点了');
        imageSelectedCallback = cb;
        imageSelector = new ImageSelector('#imageSelectorDiv', {}, function (type, data) {  // 初始化图片选择弹窗
        });
        $('#imageSelectorPop').modal({keyboard: true, backdrop: 'static'});
      },

      insertImage: function () {
        if (imageSelector.selectedItems.length === 0)
          return;

        imageSelectedCallback(imageSelector.selectedItems[0].url);   // 调用插件内部回调把图片插入到编辑器中
        $('#imageSelectorPop').modal('hide');
      }
    }
  }


</script>

<style lang="scss" scoped>

</style>

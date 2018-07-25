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
                         :value="kind.value"></mu-option>
            </mu-select>
          </mu-form-item>
          <mu-form-item prop="input" icon="today" label="选择发布日期时间">
            <mu-date-input v-model="form.create_time" :value-format="'YYYY年MM月DD日 H:i:s'" type="dateTime" full-width
                           landscape
                           actions></mu-date-input>
          </mu-form-item>
          <mu-form-item prop="input" icon="thumb" label="封面图">
            <com-uploader></com-uploader>
          </mu-form-item>
          <mu-form-item prop="input" icon="content" label="内容">

            <!--<com-editor v-model:content="form.content"></com-editor>-->

            <com-vue-mce id="postTinymce" v-model="form.content" :other_options="tinymceInit"
                         class="full-width"></com-vue-mce>

          </mu-form-item>
          <mu-button primary @click="eventPostPublishSubmit">
            提交发布
          </mu-button>
        </mu-form>
      </mu-flex>
      <mu-flex style="padding:2em">
        <com-post-extra :extraList="form.extraList"></com-post-extra>
      </mu-flex>
    </mu-flex>

  </section>
</template>

<script>
  import cateApi from '@/pages/admin/category/cateApi';
  import postApi from "./postApi";

  export default {
    name: "postPublish",
    components: {
      // 'com-editor': () => import('@/pages/components/editor-tinymce'),
      'com-uploader': () => import('@/pages/components/Uploader'),
      'com-post-extra': () => import('./postExtra'),
      'com-vue-mce': () => import('vue-tinymce-editor'),
    },
    data() {
      return {
        form: {
          kind: 'post',
          content: '',
          category: 0,
          create_time: new Date(),
          extraList: [],
        },
        postKinds: [
          {title: '文章', value: 'post'},
          {title: '写字楼', value: 'office'},
          {title: '公寓住宅', value: 'house'},
          {title: '其他', value: 'other'},
        ],
        picker: {
          create_time: {
            show: false,
          }
        },
        //  搜索框值
        filterable: {
          cateSearch: '',
          postKindSearch: '',
        },
        tinymceInit: {
          language_url: '/static/tinymce/zh_CN.js',
          language: 'zh_CN',
          skin_url: '/static/tinymce/skins/lightgray',
          height: 600,
          plugins: 'link lists image code table colorpicker textcolor wordcount contextmenu',
          toolbar1:
            'bold italic underline strikethrough | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | undo redo | link unlink image code | removeformat',
          branding: false
        }
      }
    },
    mounted() {
      if (this.handlerCateList.length < 2) {
        console.log('需要获取栏目信息')
        cateApi.getCateList();
      }
    },
    computed: {
      //  获取栏目列表
      handlerCateList: function () {
        return this.$store.getters.getCateList;
      }
    },
    methods: {
      eventCateGet: function (v) {
        console.log(v)
      },
      eventCateChange: function (v) {
        this.form.category = v;
      },
      //  切换文章类别 - 切换附加数据的模板
      eventPostKindChange: function (v) {
        this.form.kind = v
        let exlist = [];
        switch (v) {
          case 'office':
            exlist = [
              {title: '租金', name: 'price', value: 0, type: 'number'},
              {title: '面积', name: 'area', value: 0, type: 'number'},
              {title: '标签', name: 'tags', value: [], type: 'array'},
              {title: '是否已售', name: 'is_sold', value: false, type: 'boolean'},
              {title: '租售到期', name: 'sold_time', value: new Date(), type: 'datetime'},
              {title: '接盘折扣', name: 'sold_discount', value: 98, type: 'number'},
              {title: '省', name: 'province', value: '', type: 'string'},
              {title: '市', name: 'city', value: '', type: 'string'},
              {title: '区', name: 'area', value: '', type: 'string'},
              {title: '地址', name: 'address', value: '', type: 'string'},
            ]
            break;
          default:

        }
        this.form.extraList = exlist;
      },
      eventPostPublishSubmit: function () {
        let postForm = {...this.form};
        postForm.create_time = parseInt(postForm.create_time.getTime() / 1000);
        postApi.setPost(postForm);
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>

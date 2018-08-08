<template>
  <section class="gutter">
    <h3>文章数据模板</h3>
    <mu-button @click="eventPostTemplateNew">
      添加新的数据模板
    </mu-button>
    <mu-grid-list :cols="6" :padding="20" :cell-height="300">
      <mu-sub-header>模板列表</mu-sub-header>
      <mu-grid-tile v-for="(e,i) in handlerPostTemplateList" :key="i">
        <img :src="e.thumb">
        <span slot="title">{{e.title}}</span>
        <span slot="subTitle">{{e.name}}</span>
        <mu-button slot="action" icon @click="eventPostTemplateEdit(e)">
          <mu-icon value='edit'></mu-icon>
        </mu-button>
      </mu-grid-tile>
    </mu-grid-list>
    <!--模板内容-->
    <mu-dialog width="800" height="800" transition="slide-bottom" scrollable overlay-close :open.sync="popData.show">
      <h3>{{popData.title}}</h3>
      <mu-text-field full-width class="gutter" v-model="popData.form.title" label="数据模板标题"></mu-text-field>
      <mu-text-field full-width class="gutter" v-model="popData.form.name" label="数据模板标题"></mu-text-field>
      <!--<com-post-extra :extraList="popData.form.content"></com-post-extra>-->
      <mu-paper :z-depth="1" v-for="(e,i) in popData.form.content" :key="i">
        <p class="full-width gutter">
          {{e.title}}
          <small>{{e.name}}</small>
        </p>
        <mu-row gutter>
          <mu-col span="4">
            <mu-text-field full-width class="gutter" v-model="e.title" label="数据标题"></mu-text-field>
          </mu-col>
          <mu-col span="4">
            <mu-text-field full-width class="gutter" v-model="e.name" label="数据名字"></mu-text-field>
          </mu-col>
          <mu-col span="4">
            <mu-select full-width class="gutter" label="数据类型" v-model="e.type" full-width>
              <mu-option v-for="(ee,ii) in kinds" :key="ii" :label="ee.title" :value="ee.value">
              </mu-option>
            </mu-select>
          </mu-col>
        </mu-row>
      </mu-paper>
      <mu-button full @click="eventPostTempEditInsetTag">
        <mu-icon value="plus_one"></mu-icon>
        增加一个数据
      </mu-button>
      <template slot="actions">
        <mu-button v-if="popData.mode == 'new'" @click="eventPostTemplateSubmit">新增数据模板</mu-button>
        <mu-button v-if="popData.mode == 'edit'" @click="eventPostTemplateSubmit">修改数据模板</mu-button>
      </template>
    </mu-dialog>
  </section>
</template>

<script>
  import postApi from './postApi';

  export default {
    name: "postTemplate",
    components: {
      'com-post-extra': () => import('./postExtra.vue'),
    },
    data() {
      return {
        templateList: [],
        popData: {
          show: false,
          form: {},
          mode: 'new',
          title: ''
        },
        newData: {
          show: false,
          form: {}
        },
        kinds: [
          {title: '文本', value: 'string'},
          {title: '数值', value: 'number'},
          {title: '开关', value: 'boolean'},
          {title: '数组', value: 'array'},
          {title: '地址', value: 'address'},
          {title: '时间', value: 'datetime'},
        ],
        new_extra: {
          title: '', name: '', value: ''
        },
      }
    }
    ,
    computed: {
      handlerPostTemplateList: function () {
        return this.$store.getters.getPostTemplates;
      }
    }
    ,
    mounted() {
      postApi.getPostTemplates();
    }
    ,
    methods: {
      eventPostTemplateEdit: function (e) {
        this.popData.mode = 'edit';
        this.popData.title = '修改数据模板';
        this.popData.form = e;
        this.popData.show = true;
      },
      eventPostTemplateNew: function () {
        this.popData.mode = 'new';
        this.popData.title = '新增数据模板';
        this.popData.form = {title: '', name: '', content: []}
        this.popData.show = true;
      },
      eventPostTemplateSubmit: function () {
        postApi.setPostTemplate(this.popData.form);
      },
      eventPostTempEditInsetTag: function () {
        this.popData.form.content.push({...this.new_extra})
      }
    }
  }
</script>

<style scoped>

</style>

<template>
  <section>
    <mu-row>
      <mu-col>
        <mu-sub-header>
          {{title||'数据'}}
        </mu-sub-header>
        <mu-container v-if="datas.length < 1">
          暂无数据
        </mu-container>
        <mu-flex class="item" v-for="(e,i) in datas" :key="i">
          <!--数字或文本-->
          <mu-text-field v-if="e.mode==='string' || e.mode==='number' || e.mode==='address'" v-model="e.value"
                         :label="e.title"
          ></mu-text-field>
          <!--时间-->
          <mu-date-input v-if="e.mode==='datetime'" v-model="e.value"
                         hintext="0"
                         :label="e.title"
                         type="dateTime" full-width
                         landscape
                         actions></mu-date-input>

          <!--布尔-->
          <mu-switch v-if="e.mode === 'boolean'" :label='e.title' label-left v-model="e.value "></mu-switch>

          <!--数组-->
          <mu-flex direction="column" v-if="e.mode === 'array'">
            <com-tags-box :title="e.title" :value="e.value"
                          v-on:valueChange="(v)=>{e.value = v}"></com-tags-box>

            <!--分割线-->
            <!--<mu-divider></mu-divider>-->
          </mu-flex>
          <!--选择-->

        </mu-flex>
        <mu-button v-if="datas.length > 0" primary @click="eventSaveData">提交保存</mu-button>
      </mu-col>
      <mu-col>
        <mu-sub-header>增加数据</mu-sub-header>
        <mu-flex fill align-items="center" justify-content="center">
          <mu-text-field icon="title" label="数据标题" label-float v-model="newData.title"></mu-text-field>
        </mu-flex>
        <mu-flex fill align-items="center" justify-content="center">
          <mu-text-field icon="title" label="数据标识(en)" label-float v-model="newData.name"></mu-text-field>
        </mu-flex>
        <mu-flex fill>
          <mu-select fill label="类型" v-model="newData.mode" @change="eventChangeMode">
            <mu-option v-for="(e,i) in modes" :key="i" :label="e.title" :value="e.value">
            </mu-option>
          </mu-select>
        </mu-flex>
        <mu-flex fill align-items="center" justify-content="center">
          <mu-button @click="eventInsertExtra">增加附加数据</mu-button>
        </mu-flex>
      </mu-col>
    </mu-row>
  </section>
</template>

<script>
  export default {
    name: "multiParamsForm",
    props: {
      datas: {
        type: Array, default: function () {
          return [];
        }
      },
      title: {
        type: String, default: () => {
          return '';
        }
      }
    },
    components: {
      comCityPicker: () => import('@/pages/admin/components/cityPicker'),
      comTagsBox: () => import('./tagsArrayBox'),
    },
    data() {
      return {
        newData: {
          title: '', name: '', value: '', mode: 'string'
        },
        modes: [
          {title: '文本', value: 'string'},
          {title: '时间', value: 'datetime'},
          {title: '标签', value: 'array'},
          {title: '开关', value: 'boolean'},
          {title: '选择(不可用)', value: 'select'},
        ]
      }
    },
    methods: {
      eventInsertExtra: function () {
        this.datas.push({...this.newData, value: ''});
        this.newData = {title: '', name: '', value: '', mode: 'string'}
      },
      //  保存数据,抛出保存事件
      eventSaveData: function () {
        this.$emit('saveData', this.datas);
      },
      eventChangeMode: function (v) {
        switch (v) {
          case 'switch':
            this.newData.value = false;
            break;
          default:
            this.newData.value = '';
        }
      }
    }
  }
</script>

<style lang="scss" scoped>
</style>

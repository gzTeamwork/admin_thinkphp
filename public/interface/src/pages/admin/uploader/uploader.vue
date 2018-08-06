<template>
  <div>
    <input style="display: none;" ref="uploadImg" accept="image/png,image/gif,image/jpeg" v-on:change="eventUploadFileChange($event)" type="file"/>
    <mu-button @click="eventSelectFile">选择文件</mu-button>
    上传状态:{{handlerUploadStatus}}
    <mu-paper v-if="thumb">
      <mu-sub-header>
        上传素材预览
      </mu-sub-header>
      <img v-if="file !=null" :src="file.thumb" alt="素材预览"/>
      <mu-flex v-else>
        暂无上传内容
      </mu-flex>
    </mu-paper>
  </div>
</template>

<script>
  // import Vue from 'vue';
  // import Vuex from 'vuex';
  import uploaderApi from './uploaderApi';
  import uploadVuex from './uploaderVuex';

  // let uploadSelfStore = new Vuex.Store({
  //   modules: {
  //     uploadVuex
  //   }
  // })

  export default {
    // store: uploadSelfStore,
    // export default {
    name: "uploader-simple-museui",
    props:
      {
        'thumb':
          false,
      }
    ,
    data() {
      return {
        file: null,
        status: '待上传',
        uploadStatusText: [
          {'init': '待上传',},
          {'uploading': '上传中',},
          {'success': '上传成功',},
          {'error': '上传失败',},
        ],
      }
    }
    ,
    watch: {
      handlerUploadFile: function (v) {
        this.file = v;
      }
      ,
    }
    ,
    computed: {
      handlerUploadFile: function () {
        return this.$store.getters.getUploadFile;
      }
      ,
      handlerUploadStatus: function () {
        return this.$store.getters.getUploadStatus;
      }
    }
    ,
    methods: {
      eventSelectFile: function () {
        this.$refs.uploadImg.click();
        this.$store.commit('INIT');
      },
      eventUploadFileChange: function (event) {
        let vm = this;
        console.info('触发file变改事件', event);
        new Promise((resolve, reject) => {
          uploaderApi.uploadImg(event.target.files[0], '', this.$store);
          resolve(event.target.files);
        }).then((file) => {
          // console.info(vm.handlerUploadFile);
          vm.$emit('getResult', file);
        })
      },
    }
  }
</script>

<style scoped>

</style>

<template>
  <div>
    <mu-linear-progress v-if="uploading"></mu-linear-progress>
    <input style="display: none;" ref="uploadImg" accept="image/png,image/gif,image/jpeg"
           v-on:change="eventUploadFileChange($event)" type="file"/>
    <mu-button @click="eventSelectFile">选择文件</mu-button>
    上传状态:{{handlerUploadStatus}}

    <mu-paper v-if="thumb">
      <mu-sub-header>
        上传素材预览
        <mu-button v-if="file" icon small @click="clear">
          <mu-icon value="close"></mu-icon>
        </mu-button>
      </mu-sub-header>

      <div v-if="file">
        <img :src="file.thumb" alt="素材预览" width="400"/>
      </div>

      <mu-flex v-else>
        暂无上传内容
      </mu-flex>

    </mu-paper>
  </div>
</template>

<script>
  import uploaderApi from './uploaderApi';

  export default {
    name: "uploader-simple-museui",
    props:
      {
        thumb: {
          type: Boolean,
          default: () => {
            return false;
          }
        },
      },
    data() {
      return {
        file: null,
        status: '待上传',
        uploading: false,
        uploadStatusText: [
          {'init': '待上传',},
          {'uploading': '上传中',},
          {'success': '上传成功',},
          {'error': '上传失败',},
        ],
      }
    },
    watch: {
      // handlerUploadFile: function (v) {
      //   this.file = v;
      // },
    },
    computed: {
      handlerUploadFile: function () {
        return this.$store.getters.getUploadFile;
      },
      handlerUploadStatus: function () {
        return this.$store.getters.getUploadStatus;
      }
    },
    methods: {
      eventSelectFile: function () {
        this.$refs.uploadImg.click();
        this.$store.commit('INIT');
      },
      eventUploadFileChange: function (event) {
        let vm = this;
        console.info('触发file变改事件', event);
        vm.uploading = true;
        new Promise((resolve, reject) => {
          let file = uploaderApi.uploadImg(event.target.files[0]);
          if (file) {
            // console.log(file);
            resolve(file);
          }
        }).then(function (file) {
          vm.uploading = false;
          console.info(file);
          vm.file = file;
          vm.$emit('getResult', file);
          vm.$emit('finished', file);
        })
      },
      clear() {
        this.file = null;
      }
    }
  }
</script>

<style scoped>

</style>

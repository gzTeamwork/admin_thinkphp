<template>
  <section>

    <template v-if="editor === 'quill'">
      <quill-editor :height="height"
                    ref="quillEditor"
                    v-model="content"
                    :config="quillConfigs"
                    @blur="onEditorBlur($event)"
                    @focus="onEditorFocus($event)"
                    @ready="onEditorReady($event)">
      </quill-editor>
    </template>

    <template v-else>
      <vue-tinymce :height="height"
                   ref="tinymceEditor"
                   v-model="content"
                   :setting="tinyConfigs">
      </vue-tinymce>
    </template>
  </section>
</template>

<script>
  // require styles
  import 'quill/dist/quill.core.css'
  import 'quill/dist/quill.snow.css'
  import 'quill/dist/quill.bubble.css'
  import {quillEditor} from 'vue-quill-editor'

  // Import TinyMCE
  import 'tinymce/themes/modern/theme';
  import 'tinymce/plugins/paste';
  import 'tinymce/plugins/link';
  import tinymce from 'tinymce/tinymce';

  import {VueTinymce, TinymceSetting} from '@packy-tang/vue-tinymce';

  export default {
    name: "editor",
    mounted() {

    },
    beforeDestroy: function () {
      tinymce.remove(this.id);
    },
    data() {
      return {
        content: '<p>html content</p>',
        tinyConfigs: {
          ...TinymceSetting,
          height: 200,
          language_url: "langs/zh_CN.js",
          block_formats: "Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;"
        },
        quillConfigs: {
          theme: 'snow',
          height: '800px',
        },
      }
    },
    components: {
      quillEditor, VueTinymce
    },
    props: {
      editor: {
        type: String,
        default: function () {
          return 'quill';
        }
      },
      height: {
        type: Number,
        default: function () {
          return '';
        }
      }
    }, methods: {
      onEditorBlur() {

      },
      onEditorFocus() {

      },
      onEditorReady() {

      }
    }
  }
</script>

<style scoped>

</style>

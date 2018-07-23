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


  </section>
</template>

<script>
  // require styles
  import 'quill/dist/quill.core.css'
  import 'quill/dist/quill.snow.css'
  import 'quill/dist/quill.bubble.css'
  import {quillEditor} from 'vue-quill-editor'

  export default {
    name: "editor",
    mounted() {

    },
    data() {
      return {
        quillConfigs: {
          theme: 'snow',
          height: '800px',
        },
      }
    },
    components: {
      quillEditor
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
          return 800;
        }
      },
      content: {
        type: String,
        return: function () {
          return '<p>这是一篇新的文章..</p>';
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

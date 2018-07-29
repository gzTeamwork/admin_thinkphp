<template>
  <!--<textarea :id="id" :value="value"></textarea>-->
  <editor :id="id" v-model="content" :init="init"></editor>
  <!--<div v-html='content'></div>-->
</template>
<script>
  // Import TinyMCE
  import tinymce from 'tinymce/tinymce'
  import 'tinymce/themes/modern/theme'
  import Editor from '@tinymce/tinymce-vue'
  import 'tinymce/plugins/image'
  import 'tinymce/plugins/link'
  import 'tinymce/plugins/code'
  import 'tinymce/plugins/table'
  import 'tinymce/plugins/lists'
  import 'tinymce/plugins/contextmenu'
  import 'tinymce/plugins/wordcount'
  import 'tinymce/plugins/colorpicker'
  import 'tinymce/plugins/textcolor'

  const INIT = 0;
  const CHANGED = 2;
  // var EDITOR = null;

  tinymce.PluginManager.add('imageSelector', function (editor, url) {
    // Add a button that opens a window
    editor.addButton('imageSelector', {
      icon: 'image',
      tooltip: "select image from image lib",
      onclick: function () {
        editor.settings.imageSelectorCallback(function (r) {
          console.log('inserting image to editor: ' + r);
          editor.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' + r + '"/>');
        });
      }
    });

  });
  export default {
    name: 'tinymceEditor',
    data() {
      return {
        id: 'editor-' + new Date().getMilliseconds(),
        init: {
          language_url: '/static/tinymce/zh_CN.js',
          language: 'zh_CN',
          skin_url: '/static/tinymce/skins/lightgray',
          height: 600,
          plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'template paste textcolor colorpicker textpattern imagetools toc help emoticons hr codesample'],
          toolbar1:
            'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat',
          branding: false
        }
      }
    },
    props: {
      content: {
        type: String, default: function () {
          return ''
        }
      },
    },
    watch: {
      value: function (val) {
        console.log('init ' + val)
        if (this.status == INIT || tinymce.activeEditor.getContent() != val) {
          tinymce.activeEditor.setContent(val);
        }
        this.status = CHANGED
      }
    },
    mounted() {
      // this.tinymceHtml = this.content;
      tinymce.init({})
    },
    components: {Editor},
    beforeDestroy: function () {
      tinymce.get(this.id).destroy();
    }
  }


</script>

<template>
    <section class="gutter">
        <h3>文章数据模板</h3>
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
        <mu-dialog width="800" transition="slide-bottom" scrollable overlay-close :open.sync="editData.show">
            {{editData.form.title}}
            <com-post-extra :extraList="editData.form.content"></com-post-extra>
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
                editData: {
                    show: false,
                    form: {},
                }
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
                this.editData.form = e;
                this.editData.show = true
            }
        }
    }
</script>

<style scoped>

</style>

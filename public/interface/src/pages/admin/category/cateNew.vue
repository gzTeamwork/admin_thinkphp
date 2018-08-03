<template>
    <div>
        <mu-form :model="form" :label-position="'left'" label-width="100" auto-validate>
            <mu-form-item label="栏目标题" prop="title" :rules="formRules.title" help-text="请填写4个以上字符作为栏目标题">
                <mu-text-field v-model="form.title"></mu-text-field>
            </mu-form-item>
            <mu-form-item label="标识" prop="name" :rules="formRules.name" help-text="请填写4个以上英文字符作为栏目标识,不含空格和符号">
                <mu-text-field v-model="form.name"></mu-text-field>
            </mu-form-item>
            <mu-form-item  label="上级栏目" prop="parent">
                <mu-select filterable v-model="filterable.cateSearch" full-width @change="eventParentCateChange">
                    <mu-option v-for="(cate,index) in handlerGetCateList" :key="index" :label="cate.title||''"
                               :value="cate.id"></mu-option>
                </mu-select>
            </mu-form-item>
            <mu-form-item prop="input" label="栏目简述">
                <mu-text-field v-model="form.description"></mu-text-field>
            </mu-form-item>
            <mu-button primary @click="eventNewCateSubmit">提交</mu-button>
        </mu-form>
    </div>
</template>

<script>
    import cateApi from './cateApi';

    export default {
        name: "cateNew",
        data() {
            return {
                cateList: [{
                    title: '根目录'
                }],
                form: {
                    title: '',
                    name: '',
                    pid: 0,
                    description: ''
                },
                filterable: {
                    cateSearch: '',
                },
                formRules: {
                    title: [
                        {validate: (val) => !!val, message: '必须填写栏目名称'},
                        {validate: (val) => val.length >= 2, message: '用户名长度大于2'}
                    ],
                    name: [
                        {validate: (val) => !!val, message: '必须填写栏目名称'},
                        {validate: (val) => new RegExp("^[a-zA-Z]+$").test(val), message: '只能输入英文'},
                        {validate: (val) => val.length >= 4, message: '用户名长度大于4'}
                    ]
                }
            }
        },
        computed: {
            handlerGetCateList: function () {
                return this.$store.getters.getCateList;
            }
        },
        // watch: {
        //   handlerGetCateList: function (v, ov) {
        //     this.cateList = v;
        //   }
        // },
        methods: {
            eventParentCateSelect: function () {
                cateApi.getCateList();
            },
            eventNewCateSubmit: function () {
                cateApi.setCateNew(this.form);
            },
            eventParentCateChange: function (value) {
                this.form.pid = value || 0;
            }
        },
        mounted() {
            this.eventParentCateSelect();
        }
    }
</script>

<style scoped>

</style>

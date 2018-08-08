<template>
  <div>
    <mu-flex class="full-width">
      <small>{{title}}</small>
      <span style="float: right;">{{chipList.length||0}}个</span>
    </mu-flex>
    <div v-if="value" class="full-width" style="display: block;min-height: 120px;">
      <mu-chip v-for="(e,i) in getValueArray" :key="title + i" @delete="handleClose" delete>
        {{e}}
      </mu-chip>
    </div>
    <mu-flex algin-items="center">
      <mu-text-field :prefix="'增加'+title" v-model="newChip"></mu-text-field>
      <mu-button icon small color="blue300" small @click="eventAddChip">
        <mu-icon value="add"></mu-icon>
      </mu-button>
    </mu-flex>
    <mu-divider></mu-divider>
  </div>

</template>

<script>
  export default {
    name: "tagsArrayBox",
    props: {
      title: {
        type: String, default: () => {
          return ''
        }
      },
      value: {
        type: String, default: () => {
          return []
        }
      },
    },
    data() {
      return {
        newChip: '',
        chipList: [],
      }
    },
    computed: {
      getValueArray: function () {
        return this.value === '' ? [] : this.value.split(',');
      }
    },
    mounted() {
      this.chipList = this.getValueArray;
    },
    methods: {
      eventAddChip: function () {
        if (this.newChip.match('/,/')) {
        } else {
          // this.value += this.value.length < 1 ? '' + this.newChip.trim() : ',' + this.newChip.trim();
          this.chipList.push(this.newChip.trim());
        }
        this.newChip = '';
        this.$emit('valueChange', this.chipList.join(','))
      },
      handleClose: function (v) {
        this.chipList.splice(v + 1, 1);
        this.$emit('valueChange', this.chipList.join(','))
      },

    }
  }
</script>

<style scoped>

</style>

<template>
  <q-input
  v-model="values"
  :label="label"
  :dense="dense"
  outlined
  class="q-my-md"
  />
</template>
<script>
export default {
  props: {
    label: {
      type: String,
      default: ''
    },
    type: {
      type: String,
      default: 'text'
    }
  },
  data: () => ({
    dense: true,
    values: ''
  }),
  watch: {
    '$attrs.modelValue': {
      handler(val){
        this.values = val
      },
      immediate: true,
      deep: true
    }
  }
}
</script>
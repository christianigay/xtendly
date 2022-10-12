<template>
  <q-input
  v-model="values"
  :label="label"
  :dense="dense"
  :disable="disable"
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
    },
    disable: {
      type: Boolean,
      default: false
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
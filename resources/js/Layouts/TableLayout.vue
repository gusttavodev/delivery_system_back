<template>

<table class="table">
  <thead>
    <tr>
      <slot name="table-title"></slot>
    </tr>
  </thead>
  <tbody>

    <slot name="table-content"></slot>

  </tbody>
</table>

</template>

<script>
    export default {
        components: {
        },
        computed: {
            hasActions() {
                return !! this.$slots.actions
            }
        }
    }
</script>

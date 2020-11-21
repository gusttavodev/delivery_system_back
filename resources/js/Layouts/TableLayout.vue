<template>

<table class="table">
  <thead class="thead-dark">

      <slot name="table-title"></slot>

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

<template>
   <body class="flex items-center justify-center">
	<div class="container">
		<table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
			<thead class="text-white">
				<tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <slot name="table-title"></slot>
				</tr>
			</thead>
			<tbody class="flex-1 sm:flex-none">
                <slot name="table-content"></slot>
			</tbody>
		</table>
	</div>
</body>

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

<style>
  html,
  body {
    height: 100%;
  }

  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
  }
</style>

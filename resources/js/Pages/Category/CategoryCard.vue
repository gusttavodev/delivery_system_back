<template>
    <div class="card ext-white m-3" style="max-width: 18rem;">
        <img :src="photo" id="category-card" class="card-img-top" :alt="name" />
        <div class="card-body">
            <div id="category-card-actions" style="">
                <p class="card-text">{{ name }}</p>
                <jet-dropdown align="right" width="48">
                    <template #trigger>
                        <jet-secondary-button >
                            Ações
                        </jet-secondary-button>
                    </template>

                    <template #content>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Editar Pefil
                        </div>
                        <jet-dropdown-link :href="route('profile.show')">
                            Profile
                        </jet-dropdown-link>
                    </template>
                </jet-dropdown>
            </div>
        </div>
    </div>
</template>

<script>
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";

export default {
    props: ["name", "photo"],
    components: {
        JetSecondaryButton,
        JetDropdown,
        JetDropdownLink
    },
    computed: {}
};
</script>

<style scoped>
#category-card-actions {
   display: flex;
   justify-content: center;
   align-items: center;
   flex-direction: column;
}
#category-card {
    width: 300px;
    height: 200px;
}
</style>

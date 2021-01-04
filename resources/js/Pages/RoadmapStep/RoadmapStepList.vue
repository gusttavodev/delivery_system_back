<template>
    <form-layout @submitted="saveOrder">
        <template #form>
            <div class="col-span-12 sm:col-span-4">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Ordem das Etapas de Conversa</h1>
                <div class="divide-y divide-gray-300">
                    <draggable
                        v-model="$page.roadmapSteps"
                        group="people"
                        @start="drag = true"
                        @change="onDrag"
                    >
                        <transition-group type="transition" :name="'flip-list'">
                            <div
                                v-for="roadmapStep in $page.roadmapSteps"
                                :key="roadmapStep.id"
                                class="px-2 py-2 whitespace-no-wrap hover:bg-gray-50 cursor-pointer border-b-2 border-blue-100"
                            >
                                <div class="row">
                                    <div class="col leading-5 text-gray-900">
                                        Ordem: {{ roadmapStep.order }}
                                    </div>
                                    <div class="col-8 leading-5 text-gray-900">
                                        Titulo: {{ roadmapStep.title }}
                                    </div>
                                    <div class="col leading-5 text-gray-900">
                                        <jet-dropdown align="right" width="48">
                                            <template #trigger>
                                                <jet-button >
                                                    Ações
                                                </jet-button>
                                            </template>

                                            <template #content>
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Escolha uma ação
                                                </div>
                                                <jet-dropdown-link :href="route('createStepOption', roadmapStep.id)">
                                                    Gerenciar Opções
                                                </jet-dropdown-link>
                                                <jet-dropdown-link :href="route('indexProduct')">
                                                    Editar
                                                </jet-dropdown-link>
                                                <jet-dropdown-link :href="route('indexProduct')">
                                                    Remover
                                                </jet-dropdown-link>
                                            </template>
                                    </jet-dropdown>
                                    </div>
                                </div>
                            </div>
                        </transition-group>
                    </draggable>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button>
                Salvar Ordem
            </jet-button>
        </template>
    </form-layout>
</template>

<script>
import draggable from "vuedraggable";
import JetButton from "@/Jetstream/Button";
import FormLayout from "@/Layouts/FormLayout";
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'

export default {
    components: {
        draggable,
        JetButton,
        FormLayout,
        JetDropdown,
        JetDropdownLink
    },
    props: ["roadmap", "roadmapSteps"],
    data() {
        return {};
    },
    methods: {
        async saveOrder() {
            const response = await axios.post(
                route("storeOrderRoadmapStep", this.$page.roadmap.id),
                {
                    roadmapStepsList: this.$page.roadmapSteps
                }
            );
            if (response.status === 200) {
                this.$page.roadmapSteps = response.data;
            }
        },
        onDrag() {}
    },
    mounted() {}
};
</script>

<style>
.flip-list-move {
    transition: transform 0.5s;
}
.no-move {
    transition: transform 0s;
}
.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
.list-group {
    min-height: 20px;
}
.list-group-item {
    cursor: move;
}
.list-group-item i {
    cursor: pointer;
}
</style>

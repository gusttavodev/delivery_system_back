<template>
    <div class="bg-gray-200">
        <div class="container">
            <div class="flex justify-center p-4">
                <h1 class="text-xl text-blue-500">Orden das Etapas de Conversa</h1>
            </div>
            <div class="flex justify-center">
                <div class="bg-white shadow-xl rounded-lg w-1/2">
                    <ul class="divide-y divide-gray-300">
                        <draggable
                            v-model="roadmapStepsList"
                            group="people"
                            @start="drag = true"
                            @change="onDrag"
                        >
                            <transition-group
                                type="transition"
                                :name="'flip-list'"
                            >
                                <li
                                    v-for="roadmapStep in roadmapStepsList"
                                    :key="roadmapStep.id"
                                    class="px-2 py-2 whitespace-no-wrap hover:bg-gray-50 cursor-pointer border-b-2 border-blue-100"
                                >
                                    <div class="leading-5 text-gray-900">Ordem: {{roadmapStep.order}}</div>
                                    <div class="leading-5 text-gray-900">Titulo: {{roadmapStep.title}}</div>
                                </li>
                            </transition-group>
                        </draggable>
                    </ul>
                </div>

            <jet-button
                @click.native="saveOrder"
            >
                Salvar
            </jet-button>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
import JetButton from "@/Jetstream/Button";

export default {
    components: {
        draggable,
        JetButton
    },
    props: ["users", "roadmap", "roadmapSteps"],
    data() {
        return {
            roadmapStepsList: this.$page.roadmapSteps,
        };
    },
    methods: {
        async saveOrder(){
            const response = await axios.post(route('storeOrderRoadmapStep', this.$page.roadmap.id), {
                roadmapStepsList: this.roadmapStepsList
            });
            if(response.status === 200){
                this.roadmapStepsList = response.data
            }
        },
        onDrag(){

        }
    },
    mounted() {

    }
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

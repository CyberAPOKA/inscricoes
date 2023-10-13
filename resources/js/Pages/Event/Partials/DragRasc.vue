<template>
  <div>
    <div v-for="(group, index) in groupedCards" :key="index">
      <h2>{{ group.fileType }}</h2>
      <Draggable
        :list="group.cards"
        v-model="group.cards"
        group="teste"
        item-key="id"
        class="flex gap-2"
        @change="onChange"
      >
        <template #item="{ element, index }">
          <img
            class="w-32 h-32 rounded-md object-cover"
            :src="'../storage/' + element.file_path"
            :alt="index"
          />
        </template>
      </Draggable>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, reactive } from "vue";
import { computed } from "@vue/reactivity";
import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";
import { useForm } from "@inertiajs/vue3";
import Draggable from "vuedraggable";

const props = defineProps({
  event: Object,
});

const cards = ref(props.event.cards);


const groupedCards = computed(() => {
  const groups = {};

  cards.value.forEach((card) => {
    const fileType = card.file_type;
    if (!groups[fileType]) {
      groups[fileType] = [];
    }
    groups[fileType].push({ ...card, position: card.id }); // Add the position property
  });

  return reactive(
    Object.entries(groups).map(([fileType, cards]) => ({
      fileType,
      cards,
    }))
  );
});

function onChange(e) {
  let item = e.added || e.moved;

  if (!item) return;

  let index = item.newIndex;
  let prevCard = groupedCards.value[index - 1];
  let nextCard = groupedCards.value[index + 1];
  let card = groupedCards.value[index];

  let position = card.position;

  if (prevCard && nextCard) {
    position = (prevCard.position + nextCard.position) / 2;
  } else if (prevCard) {
    position = prevCard.position + prevCard.position / 2;
  } else if (nextCard) {
    position = nextCard.position / 2;
  }

  // Inertia.put(route("cards.move", { card: card.id }), {
  //   position: position,
  //   cardListId: props.list.id,
  // });

  console.log(e);
}
</script>

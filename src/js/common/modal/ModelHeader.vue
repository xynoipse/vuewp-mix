<template>
  <div class="modal-header">
    <heading v-if="title" size="4" :title="title" icon="icon" />
    <slot></slot>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</template>

<script>
import { Heading } from '@js/common/headings';

export default {
  name: 'ModalHeader',
  props: {
    title: {
      type: String,
    },
    icon: null,
  },
  components: {
    Heading,
  },
};
</script>

<script>
export default {
  name: 'MessagesList',
  props: {
    messages: {
      type: Array,
      required: true,
    },
  },
  methods: {
    formatDate(dateStr) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      const date = new Date(dateStr);
      return date.toLocaleDateString('it-IT', options);
    },

    getImage(index) {
      return this.$parent.getImage(index);
    },

    selectMessage(message, index) {
      this.$emit('selectMessage', message, index);
    },

  },
};
</script>

<template>

    <ul class="list-group list-group-flush">

      <li class="list-group-item d-flex align-items-center"
          v-for="(message, index) in messages"
          :key="index"
          @click="selectMessage(message, index)">
        <div class="image mx-3">
          <img :src="getImage(index)" alt="utente">
        </div>

        <div class="text-box my-3">
          <div class="d-flex justify-content-between">
            <h6>{{ message.name }} {{ message.surname }}</h6>
            <small>{{ formatDate(message.created_at) }}</small>
          </div>
          <small>{{ message.email }}</small>
          <p class="message-email">{{ message.message }}</p>
        </div>

      </li>

    </ul>

</template>

<style lang="scss">
@use '../../../../scss/message' as*;
</style>

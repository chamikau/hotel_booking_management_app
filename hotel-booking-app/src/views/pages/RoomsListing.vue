<template>
  <div class="rooms-page">
    <!-- Steps Card -->
    <div class="steps-card">
      <div class="step">
        <span class="step-number">1</span>
        <span class="step-label">SEARCH</span>
      </div>
      <div class="step">
        <span class="step-number active">2</span>
        <span class="step-label">SELECT ROOM</span>
      </div>
      <div class="step disabled">
        <span class="step-number">3</span>
        <span class="step-label">CONTACT INFO</span>
      </div>
      <div class="step disabled">
        <span class="step-number">4</span>
        <span class="step-label">CONFIRMATION</span>
      </div>
    </div>

    <!-- Page Header -->
    <header class="page-header">
      <h1>Select Your Room</h1>
      <p>Choose the perfect room for your stay.</p>
    </header>

    <!-- Room Grid -->
    <section class="rooms-grid">
      <div
          v-for="room in rooms"
          :key="room.id"
          class="room-card"
      >
        <img
            :src="getRoomImage(room.image)"
            alt="Room Image"
            class="room-image"
        />
        <div class="room-details">
          <h2>{{ room.name }}</h2>
          <p>{{ room.description }}</p>
          <p class="room-price">From ${{ room.price }}/night</p>
          <button @click="selectRoom(room)" class="select-btn">
            Select Room
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "RoomsListing",
  data() {
    return {
      rooms: [
      ],
    };
  },
  methods: {
    getRoomImage(imageName) {
      try {
        // Dynamically load image from src/assets
        return require(`@/assets/images/room_images/${imageName}`);
      } catch {
        // Fallback image if not found
        return require('@/assets/images/default.png');
      }
    },
    selectRoom(room) {
      this.$router.push({
        name: "ContactInfo",
        query: {
          id: room.id,
          name: room.name,
          description: room.description,
          price: room.price,
          image: room.image
        }
      });
    },
  }
};
</script>

<style scoped>
</style>

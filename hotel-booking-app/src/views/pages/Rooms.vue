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

    <!-- Rooms Grid -->
    <section class="rooms-grid">
      <div
          v-for="room in rooms"
          :key="room.id"
          class="room-card"
      >
        <img :src="room.image" :alt="room.name" class="room-image" />
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
        {
          id: 1,
          name: "Deluxe Room",
          description: "Spacious room with sea view and king-size bed.",
          price: 120,
          image: "/assets/rooms/room1.jpg",
        },
        {
          id: 2,
          name: "Standard Room",
          description: "Comfortable room with city view and queen-size bed.",
          price: 80,
          image: "/assets/rooms/room2.jpg",
        },
        {
          id: 3,
          name: "Suite",
          description: "Luxury suite with living area and premium amenities.",
          price: 200,
          image: "/assets/rooms/room3.jpg",
        },
      ],
    };
  },
  methods: {
    selectRoom(room) {
      // Navigate to ContactInfo page
      this.$router.push({
        name: "ContactInfo", // make sure this route exists in your router
        query: {
          location: this.location,
          roomId: room.id, // pass selected room id if needed
        },
      });
    },
  }
};
</script>

<style scoped>
</style>

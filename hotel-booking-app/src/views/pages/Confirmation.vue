<template>
  <div class="confirmation-page">
    <!-- Steps Card -->
    <div class="steps-card">
      <div class="step">
        <span class="step-number">1</span>
        <span class="step-label">SEARCH</span>
      </div>
      <div class="step">
        <span class="step-number">2</span>
        <span class="step-label">SELECT ROOM</span>
      </div>
      <div class="step">
        <span class="step-number">3</span>
        <span class="step-label">CONTACT INFO</span>
      </div>
      <div class="step">
        <span class="step-number">4</span>
        <span class="step-label">CONFIRMATION</span>
      </div>
    </div>

    <!-- Confirmation Message -->
    <div class="confirmation-message">
      <h1>Booking Confirmed!</h1>
      <p>Thank you for your booking. Here are your details:</p>
    </div>

    <!-- Booking Summary -->
    <div class="summary-card">
      <h2>Room Details</h2>
      <div class="room-card">
        <img :src="room.image" alt="Room Image" />
        <div class="room-info">
          <h3>{{ room.name }}</h3>
          <p>{{ room.description }}</p>
          <p class="room-price">LKR {{ room.price }}/night</p>
        </div>
      </div>

      <h2>Contact Information</h2>
      <div class="contact-info">
        <p><strong>Title:</strong> {{ contact.title }}</p>
        <p><strong>Name:</strong> {{ contact.name }}</p>
        <p><strong>Email:</strong> {{ contact.email }}</p>
        <p><strong>Address:</strong> {{ contact.address }}</p>
      </div>
    </div>

    <button @click="goDashboard" class="home-btn">Back to Dashboard</button>
  </div>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Confirmation",
  data() {
    return {
      room: {
        id: this.$route.query.roomId || 1,
        name: "Deluxe Room",
        description: "Spacious room with sea view and king-size bed.",
        price: 120,
        image: "/assets/rooms/room1.jpg",
      },
      contact: {
        title: this.$route.query.title || "Mr.",
        name: this.$route.query.name || "John Doe",
        email: this.$route.query.email || "john@example.com",
        address: this.$route.query.address || "123 Street, City",
      },
    };
  },
  methods: {
    goDashboard() {
      this.$router.push({ name: "UserDashboard" });
    },
  },
};
</script>

<style scoped>
</style>

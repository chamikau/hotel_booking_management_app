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
    <div class="summary-card" v-if="booking">
      <h2>Room Details</h2>
      <div class="room-card">
        <img
            :src="getRoomImage(booking.room.image)"
            alt="Room Image"
            class="room-image"
        />
        <div class="room-info">
          <h3>{{ booking.room.name }}</h3>
          <p>{{ booking.room.description }}</p>
          <p class="room-price">LKR {{ booking.price }}/night</p>
          <p><strong>Check-in:</strong> {{ booking.check_in }}</p>
          <p><strong>Check-out:</strong> {{ booking.check_out }}</p>
        </div>
      </div>

      <h2>Contact Information</h2>
      <div class="contact-info">
        <p><strong>Title:</strong> {{ booking.title }}</p>
        <p><strong>Name:</strong> {{ booking.name }}</p>
        <p><strong>Email:</strong> {{ booking.email }}</p>
      </div>
    </div>

    <button @click="goLogin" class="home-btn">Back to Login</button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Confirmation",
  data() {
    return {
      booking: null,
      token: localStorage.getItem("token") || "",
      bookingId: this.$route.query.bookingId || null,
    };
  },
  mounted() {
    if (this.bookingId) {
      this.fetchBooking();
    } else {
      alert("Booking ID not found");
    }
  },
  methods: {
    async fetchBooking() {
      try {
        const response = await axios.get(
            `http://localhost:8000/api/bookings/${this.bookingId}`,
            {
              headers: {
                Authorization: `Bearer ${this.token}`,
              },
            }
        );
        this.booking = response.data;
      } catch (error) {
        console.error(error);
        alert("Failed to fetch booking details.");
      }
    },
    getRoomImage(imageName) {
      try {
        return require(`@/assets/images/room_images/${imageName}`);
      } catch {
        return require("@/assets/images/default.png");
      }
    },
    goLogin() {
      this.$router.push({ name: "Login" });
    },
  },
};
</script>

<style scoped>
.summary-card {
  margin: 2rem auto;
  max-width: 600px;
}
.room-card {
  display: flex;
  gap: 15px;
  border: 1px solid #ccc;
  padding: 15px;
  border-radius: 10px;
  margin-bottom: 20px;
}
.room-image {
  width: 150px;
  height: 120px;
  object-fit: cover;
  border-radius: 10px;
}
.room-info h3 {
  margin: 0 0 5px 0;
}
.contact-info p {
  margin: 3px 0;
}
.home-btn {
  padding: 10px 20px;
  background-color: #333;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.home-btn:hover {
  background-color: #555;
}
</style>

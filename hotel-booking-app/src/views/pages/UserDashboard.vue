<template>
  <div class="dashboard-page">
    <header class="dashboard-header">
      <h1>Welcome to Your Dashboard</h1>
      <p>Manage your bookings and account details here.</p>
      <button class="logout-btn" @click="logout">Logout</button>
    </header>

    <section class="dashboard-actions">
      <div class="action-card" @click="goToRooms">
        <h2>Book a Room</h2>
        <p>Search and select the perfect room for your stay.</p>
      </div>
      <div class="action-card" @click="goToBookings">
        <h2>My Bookings</h2>
        <p>View all your upcoming and past bookings.</p>
      </div>
      <div class="action-card" @click="goToProfile">
        <h2>Profile</h2>
        <p>Update your personal information and settings.</p>
      </div>
    </section>

    <section class="recent-bookings">
      <h2>Recent Bookings</h2>

      <div v-if="bookings.length === 0" class="no-bookings">
        No recent bookings.
      </div>

      <div
          v-else
          class="booking-card"
          v-for="booking in bookings"
          :key="booking.id"
      >
        <!-- Room Image -->
        <img
            :src="getRoomImage(booking.room.image)"
            alt="Room Image"
            class="room-image"
        />

        <!-- Room Details -->
        <div class="booking-details">
          <h3>{{ booking.room.name }}</h3>
          <p><strong>Check-in:</strong> {{ booking.check_in }}</p>
          <p><strong>Check-out:</strong> {{ booking.check_out }}</p>
          <p><strong>Guests:</strong> {{ booking.room.guests }}</p>
          <p><strong>Price:</strong> LKR {{ booking.price }}</p>
        </div>
      </div>
    </section>

  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "UserDashboard",
  data() {
    return {
      bookings: [],
      token: localStorage.getItem("token") || "",
      userEmail: localStorage.getItem("userEmail") || "",
    };
  },
  mounted() {
    this.fetchRecentBookings();
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
    async fetchRecentBookings() {
      try {
        const API_URL = "https://hotel_booking_management_app.railway.internal";
        const response = await axios.get(`${API_URL}/bookings/recent`, {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
          params: {
            email: this.userEmail, // ✅ Send email here
          },
        });
        this.bookings = response.data;

      } catch (error) {
        console.error(error);
        alert("Failed to fetch bookings.");
      }
    },
    goToRooms() {
      this.$router.push({ name: "RoomSearch" });
    },
    goToBookings() {
      alert("Go to bookings page (not implemented yet).");
    },
    goToProfile() {
      alert("Go to profile page (not implemented yet).");
    },
    logout() {
      localStorage.removeItem("token");
      localStorage.removeItem("userEmail");
      this.$router.push({ name: "RoomSearch" });
    },
  },
};
</script>

<style scoped>
.dashboard-header {
  position: relative;
  text-align: center;
  margin-bottom: 30px;
}

.logout-btn {
  position: absolute;
  top: 0;
  right: 0;
  padding: 8px 15px;
  font-size: 14px;
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.logout-btn:hover {
  background-color: #555;
}

.recent-bookings {
  margin-top: 30px;
}

.recent-bookings {
  margin-top: 30px;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 20px;
}

.booking-card {
  display: flex;
  flex-direction: column;
  background-color: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  transition: transform 0.2s, box-shadow 0.2s;
}

.booking-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.room-image {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.booking-details {
  padding: 15px 20px;
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.booking-details h3 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 5px;
}

.booking-details p {
  font-size: 0.95rem;
  color: #555;
  margin: 0;
}

.booking-details p strong {
  color: #222;
}

</style>

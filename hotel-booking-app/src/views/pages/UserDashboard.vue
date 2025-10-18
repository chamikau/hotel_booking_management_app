<template>
  <div class="dashboard-page">
    <!-- Page Header -->
    <header class="dashboard-header">
      <h1>Welcome to Your Dashboard</h1>
      <p>Manage your bookings and account details here.</p>
      <button class="logout-btn" @click="logout">Logout</button>
    </header>

    <!-- Quick Links / Actions -->
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

    <!-- Recent Bookings -->
    <section class="recent-bookings">
      <h2>Recent Bookings</h2>
      <div v-if="bookings.length === 0" class="no-bookings">
        No recent bookings.
      </div>
      <div v-else class="booking-card" v-for="booking in bookings" :key="booking.id">
        <h3>{{ booking.roomName }}</h3>
        <p><strong>Date:</strong> {{ booking.date }}</p>
        <p><strong>Price:</strong> LKR {{ booking.price }}</p>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "UserDashboard",
  data() {
    return {
      bookings: [
        {
          id: 1,
          roomName: "Deluxe Room",
          date: "2025-10-20 to 2025-10-22",
          price: 240,
        },
        {
          id: 2,
          roomName: "Standard Room",
          date: "2025-11-05 to 2025-11-07",
          price: 160,
        },
      ],
    };
  },
  methods: {
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
      // Clear auth (example: remove token, reset user data)
      alert("You have been logged out.");
      this.$router.push({name: "Login"}); // redirect to login page
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

/* Keep existing dashboard styles from previous CSS */
</style>

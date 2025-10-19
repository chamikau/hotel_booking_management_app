<template>
  <div class="contact-page">
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
      <div class="step">
        <span class="step-number">3</span>
        <span class="step-label">CONTACT INFO</span>
      </div>
      <div class="step disabled">
        <span class="step-number">4</span>
        <span class="step-label">CONFIRMATION</span>
      </div>
    </div>

    <!-- Contact Form -->
    <section class="content">
      <!-- Left: Contact Form -->
      <div class="contact-form">
        <form @submit.prevent="submitContact">
          <div class="form-group">
            <label for="title">Title</label>
            <select id="title" v-model="contact.title" required>
              <option value="">Select</option>
              <option>Mr.</option>
              <option>Mrs.</option>
              <option>Ms.</option>
              <option>Dr.</option>
            </select>
          </div>

          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" v-model="contact.name" required />
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="contact.email" required />
          </div>

          <div class="form-group">
            <label for="check_in">Check-in Date</label>
            <input type="date" id="check_in" v-model="contact.check_in" required />
          </div>

          <div class="form-group">
            <label for="check_out">Check-out Date</label>
            <input type="date" id="check_out" v-model="contact.check_out" required />
          </div>

          <button type="submit" class="submit-btn">PROCEED</button>
        </form>
      </div>

      <!-- Right: Selected Room Details -->
      <aside class="room-summary">
        <h2>Selected Room</h2>
        <div class="room-card">
          <img
              :src="getRoomImage(selectedRoom.image)"
              alt="Room Image"
              class="room-image"
          />
          <div class="room-info">
            <h3>{{ selectedRoom.name }}</h3>
            <p>{{ selectedRoom.description }}</p>
            <p class="room-price">LKR {{ selectedRoom.price }}/night</p>

            <!-- Show Check-in & Check-out Dates -->
            <div v-if="contact.check_in && contact.check_out" class="room-dates">
              <p><strong>Check-in:</strong> {{ contact.check_in }}</p>
              <p><strong>Check-out:</strong> {{ contact.check_out }}</p>
            </div>
          </div>
        </div>
      </aside>
    </section>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "ContactInfo",
  data() {
    return {
      contact: {
        title: "",
        name: "",
        email: "",
        check_in: "",
        check_out: "",
      },
      selectedRoom: {
        id: null,
        name: "",
        description: "",
        price: null,
        image: "",
      },
    };
  },
  mounted() {
    // Load selected room from router query
    this.selectedRoom = {
      id: this.$route.query.id,
      name: this.$route.query.name,
      description: this.$route.query.description,
      price: this.$route.query.price,
      image: this.$route.query.image,
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
    async submitContact() {
      try {
        const response = await axios.post('http://localhost:8000/api/bookings', {
          title: this.contact.title,
          name: this.contact.name,
          email: this.contact.email,
          room_id: this.selectedRoom.id,
          price: this.selectedRoom.price,
          check_in: this.contact.check_in,
          check_out: this.contact.check_out
        });
        const bookingId = response.data.booking.id;
        this.$router.push({
          name: "Confirmation",
          query: {
            bookingId: bookingId,
            roomId: this.selectedRoom.id,
            roomName: this.selectedRoom.name,
            roomDesc: this.selectedRoom.description,
            roomPrice: this.selectedRoom.price,
            roomImage: this.selectedRoom.image,
            title: this.contact.title,
            name: this.contact.name,
            email: this.contact.email,
            check_in: this.contact.check_in,
            check_out: this.contact.check_out
          },
        });
      } catch (error) {
        console.error(error);
        alert("Failed to save customer.");
      }
    },
  },
};
</script>

<style scoped>
.contact-form {
  margin: 3rem;
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 15px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
  display: block;
}

input, select {
  width: 100%;
  padding: 8px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.submit-btn {
  padding: 10px 20px;
  font-weight: bold;
  background-color: #333;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.submit-btn:hover {
  background-color: #555;
}

.room-summary {
  margin: 3rem;
}

.room-card {
  border: 1px solid #ccc;
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 15px;
}

.room-image {
  width: 100%;
  max-width: 300px;
  border-radius: 10px;
  margin-bottom: 10px;
}

.room-info h3 {
  margin: 10px 0 5px;
}

.room-dates {
  margin-top: 10px;
  font-weight: 500;
}

.room-dates p {
  margin: 3px 0;
}
</style>

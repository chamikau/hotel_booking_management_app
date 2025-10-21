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
      <div class="contact-form">
        <form @submit.prevent="submitContact">
          <!-- Title -->
          <div class="form-group">
            <label for="title">Title</label>
            <select id="title" v-model="contact.title" required>
              <option value="">Select</option>
              <option>Mr.</option>
              <option>Mrs.</option>
              <option>Ms.</option>
              <option>Dr.</option>
            </select>
            <span v-if="errors.title" class="error-msg">{{ errors.title }}</span>
          </div>

          <!-- Name -->
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" v-model="contact.name" />
            <span v-if="errors.name" class="error-msg">{{ errors.name }}</span>
          </div>

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="contact.email" />
            <span v-if="errors.email" class="error-msg">{{ errors.email }}</span>
          </div>

          <!-- Check-in -->
          <div class="form-group">
            <label for="check_in">Check-in Date</label>
            <input type="date" id="check_in" v-model="contact.check_in" />
            <span v-if="errors.check_in" class="error-msg">{{ errors.check_in }}</span>
          </div>

          <!-- Check-out -->
          <div class="form-group">
            <label for="check_out">Check-out Date</label>
            <input type="date" id="check_out" v-model="contact.check_out" />
            <span v-if="errors.check_out" class="error-msg">{{ errors.check_out }}</span>
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
import axios from "axios";

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
      errors: {}, // validation errors
    };
  },
  mounted() {
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
        return require(`@/assets/images/room_images/${imageName}`);
      } catch {
        return require("@/assets/images/default.png");
      }
    },
    validateForm() {
      this.errors = {};

      if (!this.contact.title) {
        this.errors.title = "Title is required";
      }
      if (!this.contact.name) {
        this.errors.name = "Name is required";
      }
      if (!this.contact.email) {
        this.errors.email = "Email is required";
      } else if (!/\S+@\S+\.\S+/.test(this.contact.email)) {
        this.errors.email = "Email is invalid";
      }
      if (!this.contact.check_in) {
        this.errors.check_in = "Check-in date is required";
      }
      if (!this.contact.check_out) {
        this.errors.check_out = "Check-out date is required";
      }
      if (
          this.contact.check_in &&
          this.contact.check_out &&
          this.contact.check_out < this.contact.check_in
      ) {
        this.errors.check_out = "Check-out cannot be before check-in";
      }

      return Object.keys(this.errors).length === 0;
    },
    async submitContact() {
      if (!this.validateForm()) return;

      try {
        const API_URL = "https://hotel_booking_management_app.railway.internal";
        const response = await axios.post(`${API_URL}/api/bookings`, {
          title: this.contact.title,
          name: this.contact.name,
          email: this.contact.email,
          room_id: this.selectedRoom.id,
          price: this.selectedRoom.price,
          check_in: this.contact.check_in,
          check_out: this.contact.check_out,
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
            check_out: this.contact.check_out,
          },
        });
      } catch (error) {
        console.error(error);
        alert("Failed to save booking.");
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

input,
select {
  width: 100%;
  padding: 8px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.error-msg {
  color: red;
  font-size: 13px;
  margin-top: 3px;
  display: block;
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

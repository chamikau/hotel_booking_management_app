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

    <!-- Choose Login or Guest -->
    <div v-if="!showForm" class="login-guest-options">
      <h2>Welcome!</h2>
      <p>Please choose an option to continue:</p>
      <button class="option-btn" @click="showLogin = true">Login</button>
      <button class="option-btn" @click="startGuest">Continue as Guest</button>
    </div>

    <!-- Login Form -->
    <section v-if="showLogin && !showForm" class="contact-form">
      <h3>Login</h3>
      <form @submit.prevent="loginUser">
        <div class="form-group">
          <label for="emailLogin">Email</label>
          <input type="email" id="emailLogin" v-model="login.email" required />
        </div>
        <div class="form-group">
          <label for="passwordLogin">Password</label>
          <input type="password" id="passwordLogin" v-model="login.password" required />
        </div>
        <button type="submit" class="submit-btn" style="margin-right: 1rem">LOGIN</button>
        <button type="button" class="submit-btn" @click="showLogin = false">Back</button>
      </form>
    </section>

    <!-- Contact Form -->
    <section v-if="showForm" class="content">
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

          <button type="submit" class="submit-btn">PROCEED</button>
        </form>
      </div>

      <!-- Right: Selected Room Details -->
      <aside class="room-summary">
        <h2>Selected Room</h2>
        <div class="room-card">
          <img :src="selectedRoom.image" alt="Room Image" />
          <div class="room-info">
            <h3>{{ selectedRoom.name }}</h3>
            <p>{{ selectedRoom.description }}</p>
            <p class="room-price">LKR {{ selectedRoom.price }}/night</p>
          </div>
        </div>
      </aside>
    </section>
  </div>
</template>

<script>
export default {
  name: "ContactInfo",
  data() {
    return {
      showForm: false,
      showLogin: false,
      login: {
        email: "",
        password: "",
      },
      contact: {
        title: "",
        name: "",
        email: "",
      },
      selectedRoom: {
        id: 1,
        name: "Deluxe Room",
        description: "Spacious room with sea view and king-size bed.",
        price: 120,
        image: "/assets/rooms/room1.jpg",
      },
    };
  },
  methods: {
    startGuest() {
      this.showForm = true;
    },
    loginUser() {
      // Mock login (replace with your API call)
      if (this.login.email && this.login.password) {
        // Example: prefill contact info after login
        this.contact.title = "Mr.";
        this.contact.name = "John Doe";
        this.contact.email = this.login.email;
        this.showForm = true;
        this.showLogin = false;
      } else {
        alert("Invalid credentials");
      }
    },
    submitContact() {
      // Redirect to Confirmation page with query params
      this.$router.push({
        name: "Confirmation",
        query: {
          roomId: this.selectedRoom.id,
          roomName: this.selectedRoom.name,
          roomDesc: this.selectedRoom.description,
          roomPrice: this.selectedRoom.price,
          roomImage: this.selectedRoom.image,
          title: this.contact.title,
          name: this.contact.name,
          email: this.contact.email,
        },
      });
    },
  },
};
</script>

<style scoped>
.login-guest-options {
  text-align: center;
  margin: 40px 0;
}
.option-btn {
  margin: 10px;
  padding: 10px 20px;
  font-size: 1rem;
  border-radius: 5px;
  border: none;
  background-color: #333;
  color: #fff;
  cursor: pointer;
}
.option-btn:hover {
  background-color: #555;
}
.contact-form {
  margin: 5rem !important;
}
</style>

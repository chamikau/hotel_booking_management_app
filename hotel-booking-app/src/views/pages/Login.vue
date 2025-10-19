<template>
  <div class="login-page">
    <div class="login-card">
      <h1>Login</h1>
      <p>Enter your credentials to continue</p>

      <form @submit.prevent="loginUser">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="login.email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" v-model="login.password" required />
        </div>

        <button type="submit" class="login-btn">Login</button>
      </form>

      <p class="register-link">
        Don't have an account?
        <router-link to="/register">Register Here</router-link>
      </p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "LoginPage",
  data() {
    return {
      login: {
        email: "",
        password: "",
      },
      errorMessage: "",
    };
  },
  methods: {
    async loginUser() {
      try {
        const API_URL = "https://hotel-booking-backend.up.railway.app/api";
        const response = await axios.post(`${API_URL}/api/login`, this.login);

        localStorage.setItem("userEmail",  this.login.email);
        // Save token or user info if returned
        localStorage.setItem("token", response.data.token);

        // Redirect to dashboard
        this.$router.push({name: "UserDashboard"});
      } catch (error) {
        console.error(error);
        this.errorMessage = error.response?.data?.message || "Login failed. Try again.";
        alert(this.errorMessage);
      }
    },
  },
};
</script>

<style scoped>
.login-page {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f4f4f4;
}

.login-card {
  background-color: #fff;
  padding: 40px 30px;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  width: 350px;
  text-align: center;
}

.login-card h1 {
  margin-bottom: 10px;
}

.login-card p {
  margin-bottom: 20px;
  color: #555;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
  text-align: left;
}

.form-group label {
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group input {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 1rem;
}

.login-btn {
  width: 100%;
  padding: 12px;
  background-color: #333;
  color: #fff;
  font-size: 1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login-btn:hover {
  background-color: #555;
}

.register-link {
  margin-top: 15px;
  font-size: 0.9rem;
}
</style>

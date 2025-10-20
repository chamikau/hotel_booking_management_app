<template>
  <div class="register-page">
    <div class="register-card">
      <h1>Register</h1>
      <p>Create a new account</p>

      <form @submit.prevent="registerUser">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" v-model="user.name" required />
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="user.email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" v-model="user.password" required />
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" id="password_confirmation" v-model="user.password_confirmation" required />
        </div>

        <button type="submit" class="submit-btn">Register</button>
      </form>

      <p class="login-link">
        Already have an account? <router-link to="/login">Login here</router-link>
      </p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Register",
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  methods: {
    async registerUser()
    {
      try {
        await axios.post('http://localhost:8000/api/register', this.user);
        alert("Registration successful!");
        localStorage.setItem("userEmail", this.user.email);
        this.$router.push('/login'); // Redirect to login after successful registration
      } catch (error) {
        console.error(error);
        if (error.response && error.response.data) {
          alert(`Error: ${JSON.stringify(error.response.data.errors)}`);
        } else {
          alert("An error occurred during registration.");
        }
      }
    },
  },
};
</script>

<style scoped>
.register-page {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f4f4f4;
}

.register-card {
  background-color: #fff;
  padding: 40px;
  border-radius: 8px;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.register-card h1 {
  margin-bottom: 10px;
}

.register-card p {
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
}

.submit-btn {
  width: 100%;
  padding: 10px;
  background-color: #333;
  color: #fff;
  font-size: 16px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  margin-top: 10px;
}

.submit-btn:hover {
  background-color: #555;
}

.login-link {
  margin-top: 15px;
  font-size: 14px;
  color: #555;
}
</style>

<template>
  <div class="container--small">
    <ul class="tab">
      <li class="tab__item" :class="{ 'tab__item--active': tab === 1 }" @click="tab = 1">Login</li>
      <li class="tab__item" :class="{ 'tab__item--active': tab === 2 }" @click="tab = 2">Register</li>
    </ul>
    <!-- {{ tab }} -->

    <div class="panel" v-show="tab === 1">
      <h1>Login</h1>
      <form class="form" @submit.prevent="login">
        <label for="login-email">Email</label>
        <input type="text" class="form__item" id="login-email" v-model="loginForm.email" />
        <label for="login-password">Password</label>
        <input type="password" class="form__item" id="login-password" v-model="loginForm.password" />
        <div class="from__button">
          <button type="submit" class="button button--inverse">login</button>
        </div>
      </form>
    </div>
    <div class="panel" v-show="tab === 2">
      <h1>Register</h1>
      <form class="form" @submit.prevent="register">
        <label for="username">Name</label>
        <input type="text" class="form__item" id="username" v-model="registerForm.name" />
        <label for="email">email</label>
        <input type="text" class="form__item" id="email" v-model="registerForm.email" />
        <label for="password">password</label>
        <input type="password" class="form__item" id="password" v-model="registerForm.password" />
        <label for="password-confirmation">password(confirm)</label>
        <input
          type="password"
          class="form__item"
          id="password-confirmation"
          v-model="registerForm.password_confirmation"
        />

        <div class="from__button">
          <button type="submit" class="button button--inverse">register</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      tab: 1,
      loginForm: {
        email: "",
        password: ""
      },
      registerForm: {
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      }
    };
  },
  methods: {
    async login() {
      console.log(this.loginForm);
    },
    async register() {
      // authストアのregisterアクションを呼び出す
      try {
        await this.$store.dispatch("auth/register", this.registerForm);
      } catch (error) {
        console.log(error);
      }
      // トップページ
      this.$router.push("/");
      // 確認の為コンソールに出力
    }
  }
};
</script>

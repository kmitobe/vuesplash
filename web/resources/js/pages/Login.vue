<template>
  <div class="container--small">
    <ul class="tab">
      <li class="tab__item" :class="{ 'tab__item--active': tab === 1 }" @click="tab = 1">Login</li>
      <li class="tab__item" :class="{ 'tab__item--active': tab === 2 }" @click="tab = 2">Register</li>
    </ul>
    <!-- {{ tab }} -->

    <div class="panel" v-show="tab === 1">
      <h1>Login</h1>
      <!-- エラーメッセージ -->
      <form class="form" @submit.prevent="login">
        <div v-if="loginErrors" class="errors">
          <ul v-if="loginErrors.email">
            <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="loginErrors.password">
            <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
          </ul>
        </div>
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
        <div v-if="registerErrors" class="errors">
          <ul v-if="registerErrors.name">
            <li v-for="msg in registerErrors.name" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="registerErrors.email">
            <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="registerErrors.password">
            <li v-for="msg in registerErrors.password" :key="msg">{{ msg }}</li>
          </ul>
        </div>
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
  computed: mapState({
    apiStatus: state => state.auth.apiStatus,
    loginErrors: state => state.auth.loginErrorMessages,
    registerErrors: state => state.auth.registerErrorMessages
  }),
  methods: {
    async login() {
      await this.$store.dispatch("auth/login", this.loginForm);
      if (this.apiStatus) {
        // トップページ
        this.$router.push("/");
      }
    },
    async register() {
      // authストアのregisterアクションを呼び出す
      await this.$store.dispatch("auth/register", this.registerForm);
      if (this.apiStatus) {
        // トップページへ移動する
        this.$router.push("/");
      }
    },
    clearError() {
      this.$store.commit("auth/setLoginErrorMessages", null);
      this.$store.commit("auth/setRegisterErrorMessages", null);
    },
    created() {
      this.clearError();
    }
  }
  // computed: {
  //   apiStatus() {
  //     return this.$store.state.auth.apiStatus;
  //   },
  //   loginErrors() {
  //     return this.$store.state.auth.loginErrorMessages;
  //   }
  // }
};
</script>

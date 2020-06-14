import Vue from "vue";
// bootstrapをインポート
import "./bootstrap";
// ルーティングの定義をインポートする
import router from "./router";
// ルートコンポーネントをインポートする
import App from "./App.vue";
// ストアをインポート
import store from "./store";

const createApp = async () => {
    await store.dispatch("auth/currentUser");
    new Vue({
        el: "#app",
        router, // ルーティングの定義を読み込む
        store, //　ストアの定義を読み込む
        components: { App }, // ルートコンポーネントの使用を宣言する
        template: "<App />" // ルートコンポーネントを描画する
    });
};
createApp();

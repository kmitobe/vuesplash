import Vue from 'vue'
// ルーティング定義をインポートする
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'

require('./bootstrap');

new Vue({
  el: '#app',
  router,//ルーティングの定義を読み込む
  components:{ App },//ルートコンポーネントの使用を宣言
  template: '<App />'//ルートコンポーネントを描画する
})
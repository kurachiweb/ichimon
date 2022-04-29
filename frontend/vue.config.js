const { defineConfig } = require('@vue/cli-service');
module.exports = defineConfig({
  transpileDependencies: ['vuetify'],
  devServer: {
    port: 55001
  },
  pages: {
    index: {
      entry: 'src/main.ts',
      title: '一問',
      description: 'Webアンケートサービスの、一問です。忙しい日々の合間に、10秒で回答できます。'
    }
  }
});

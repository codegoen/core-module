import stores from "./stores";

export default {
  install: (app, options) => {
    app.use(stores);
  },
};

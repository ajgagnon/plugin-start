const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require("path");

module.exports = [
  {
    ...defaultConfig[0],
    resolve: {
      ...defaultConfig[0].resolve,
      extensions: [".tsx", ".ts", ".js", ".jsx"],
      alias: {
        "@": path.resolve(__dirname, "./assets/scripts/admin"),
      },
    },
  },
  defaultConfig[1],
];

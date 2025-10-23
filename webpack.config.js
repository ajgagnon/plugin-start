const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require("path");

module.exports = [
  {
    ...defaultConfig[0],
    entry: {
      admin: path.resolve(__dirname, "./assets/scripts/admin/index.js"),
      front: path.resolve(__dirname, "./assets/scripts/front/index.js"),
    },
    output: {
      ...defaultConfig[0].output,
      filename: "[name].js",
      path: path.resolve(__dirname, "build"),
    },
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

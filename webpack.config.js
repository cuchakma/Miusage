const defaults = require('@wordpress/scripts/config/webpack.config');
const path = require("path");
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");

const plugins = defaults.plugins.filter(
  (plugin) =>
      plugin.constructor.name != "MiniCssExtractPlugin" &&
      plugin.constructor.name != "CleanWebpackPlugin"
);

module.exports = {
  ...defaults,
  entry:{
    "entry-point": path.resolve(__dirname, 'assets/admin/scripts/index.js')
  },
  output:{
    ...defaults.output,
    filename:"[name].js",
    path:path.resolve(__dirname, 'assets/admin/build')
  },
  plugins: [
    new MiniCSSExtractPlugin({
        filename: ({ chunk }) => {
            return `css/${chunk.name}.css`;
        },
    }),
    ...plugins,
  ]
};
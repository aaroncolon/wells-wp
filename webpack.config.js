const webpack = require('webpack');
const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

const config = {
  entry: './js/src/index.js',
  output: {
    path: path.resolve(__dirname, './js/dist'),
    filename: 'bundle.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: 'babel-loader',
      }
    ]
  },
  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin({
        exclude: /\/royalslider/
      })
    ]
  }
};

module.exports = config;

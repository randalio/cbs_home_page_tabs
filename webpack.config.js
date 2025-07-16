const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  mode: 'development',
  entry: {
    main: [
      path.resolve(__dirname, 'src/js/main.js'),
      path.resolve(__dirname, 'src/scss/main.scss')
    ]
  },
  output: {
    filename: 'js/[name].js',
    path: path.resolve(__dirname, 'dist'),
    clean: false
  },
  resolve: {
    extensions: ['.js', '.scss', '.css'],
    modules: [path.resolve(__dirname, 'src'), 'node_modules']
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },
      {
        test: /\.scss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '../'
            }
          },
          'css-loader',
          'sass-loader'
        ]
      },
      {
        test: /\.css$/i,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              // Remove or adjust publicPath for node_modules CSS
              publicPath: (resourcePath, context) => {
                // Use different publicPath for node_modules vs local files
                if (resourcePath.includes('node_modules')) {
                  return '/'; // or '../' depending on your setup
                }
                return '../';
              }
            }
          },
          'css-loader'
        ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/[name].css'
    })
  ],
  devtool: 'source-map'
};
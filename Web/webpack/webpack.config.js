const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');


module.exports = {
    entry: './src/index.js',
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'dist') 
    },
    module: {
        rules: [
            {
               test: /\.s[ac]ss$/i,
               use: [
                'style-loader',
                'css-loader',
                'sass-loader',
               ]
            }
        ]
    },
    plugins: [
        new HtmlWebpackPlugin({
            title: 'Test Webpack - IUT',
            template: './src/index.html'
        })
    ]
}
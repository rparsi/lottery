const webpack = require('webpack');
const path = require('path');

const codeDirectory = path.resolve(__dirname, 'src'); // frontend/src
const webDirectory = path.resolve(__dirname, '../web'); // web
const distDirectory = path.resolve(__dirname, '../web/js/dist'); // web/js/dist

// extractCommons is a core webpack plugin that ships with webpack
// It is used to create separate modules with shared code across multiple entry points.
// In this case shared modules will be compiled into web/dist/commons.js,
// which must be loaded by your html, before other modules
const extractCommons = new webpack.optimize.CommonsChunkPlugin({
    name: 'commons',
    filename: 'commons.js'
});

const config = {
    context: codeDirectory,
    // Instructs webpack to compile our entry point frontend/src/app.js into our
    // output web/js/dist/[name from entry].bundle.js
    // All js files will be transpiled by babel to ES2015 to ES5
    // ES6 is shorthand form of ES2015
    // ES6 code gets transpiled to ES5 as browser compatibility is not universal yet
    entry: {
        app: './app.js' // points to frontend/src/app.js
    },
    output: {
        path: distDirectory, // should point to web/js/dist
        filename: '[name].bundle.js' // thus we should get web/js/dist/app.bundle.js
    },
    module: {
        rules: [{
            test: /\.js$/,
            include: codeDirectory,
            use: [{
                loader: 'babel-loader',
                options: {
                    presets: [
                        ['es2015', { modules: false }]
                    ]
                }
            }]
        }]
    },
    plugins: [
        extractCommons
    ]
};

module.exports = config;
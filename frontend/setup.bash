#!/bin/bash

if [ ! -f "./package.json" ]; then
    npm init
fi

if [ ! -f "./node_modules/webpack/bin/webpack.js" ]; then
    npm install webpack --save-dev
    npm install babel-core babel-loader babel-preset-es2015 --save-dev
    npm install css-loader style-loader sass-loader node-sass --save-dev
    npm install jquery --save
    npm install bootstrap --save
    npm install react --save
fi

echo 'Update package.json “scripts” section to incorporate webpack into build process'
echo '    "scripts": {'
echo '        "start": "webpack --watch",'
echo '        "build": "webpack -p"'
echo '    },'
echo
echo 'The "build" script is NOT one of the predefined npm script stages, so to run our build process:"'
echo '    npm run build'
echo

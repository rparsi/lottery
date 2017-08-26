#!/bin/bash

if [ ! -f "./package.json" ]; then
    ./setup.bash
fi

if [ ! -f "./jspm" ]; then
    ln -s ./node_modules/jspm/jspm.js ./jspm
fi
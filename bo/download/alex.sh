#!/bin/bash
for file in $(find . -name '*.JPG'); do cp $file $(dirname $file)/thumb_$(basename $file); done

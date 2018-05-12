#!/bin/sh
name=release;
rm -r ./$name/ 
mkdir $name
cp -a dist screenshot.* *.php common ./$name
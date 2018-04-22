#!/bin/sh
name=release;
rm -r ./$name/ 
mkdir $name
cp -a dist img screenshot.* *.php ./$name
cp -a src/img ./$name/dist
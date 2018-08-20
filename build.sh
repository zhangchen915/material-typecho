#!/bin/sh
name="./release";

if [[ ! -d "$name" ]]; then
	mkdir $name
else
	rm -r $name
	mkdir $name
fi

cp -a dist screenshot.* *.php common $name
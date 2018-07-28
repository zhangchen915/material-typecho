#!/bin/sh
name="./release";

if [[ ! -d "$name" ]]; then
	mkdir $name
else
	rm -r $name
fi

cp -a dist screenshot.* *.php common $name
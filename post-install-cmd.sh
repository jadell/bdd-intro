#!/bin/bash
cd "`dirname $0`/vendor"

CPU=`uname -m`

# Download and extract 3rd party binaries
DOWNLOAD_FILES=""
DOWNLOAD_FILES="$DOWNLOAD_FILES https://selenium.googlecode.com/files/selenium-server-standalone-2.35.0.jar"
if [ "$CPU" = "x86_64" ]; then
	DOWNLOAD_FILES="$DOWNLOAD_FILES http://chromedriver.storage.googleapis.com/2.4/chromedriver_linux64.zip"
	DOWNLOAD_FILES="$DOWNLOAD_FILES https://phantomjs.googlecode.com/files/phantomjs-1.9.2-linux-x86_64.tar.bz2"
else
	DOWNLOAD_FILES="$DOWNLOAD_FILES http://chromedriver.storage.googleapis.com/2.4/chromedriver_linux32.zip"
	DOWNLOAD_FILES="$DOWNLOAD_FILES https://phantomjs.googlecode.com/files/phantomjs-1.9.2-linux-i686.tar.bz2"
fi

for FILE in $DOWNLOAD_FILES; do
	BASEFILE=`basename $FILE`
	if [ ! -f "$BASEFILE" ]; then
		wget $FILE

		if [ $? -ne 0 ]; then
			echo "Could not download $FILE"
			exit 1
		fi

		EXT="${BASEFILE##*.}"
		if [ "$EXT" = "zip" ]; then
			unzip $BASEFILE
		elif [ "$EXT" = "bz2" ]; then
			tar -xvjf $BASEFILE
		fi

	fi
done

# Link the binaries in vendor/bin
cd bin
ln -sfn ../selenium-server-standalone* selenium-server-standalone.jar
ln -sfn ../phantomj*/bin/phantomjs phantomjs
ln -sfn ../chromedriver chromedriver

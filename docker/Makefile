PWD := $(shell pwd)


build:
	# Build website

	cd $(PWD)/web; \
	sudo docker build -t webpocketinnocity .

	# All logs are share between the host folder:/etc/pocketinnocity/logs
	# With the docker folder:/var/log/apache2
	# Test
	#sudo docker run --name=apachepocketinnocity -v /etc/pocketinnocity/logs:/var/log/apache2 -it -p 8080:80 -p 8443:443 webpocketinnocity

	sudo docker run --name=apachepocketinnocity -v /etc/pocketinnocity/logs:/var/log/apache2 -d -p 8081:80 -p 8443:443 webpocketinnocity

build:
	sudo docker build -t test .
	sudo docker run --name=webpocketinnocity -v /etc/pocketinnocity/logs:/var/log/apache2 -it -p 8080:80 -p 8443:443 test
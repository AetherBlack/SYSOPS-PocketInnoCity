PWD := $(shell pwd)

build:
	# Build website
	cd $(PWD)/web; \
	sudo docker build -t web .

	# All logs are share between the host folder:/etc/pocketinnocity/logs
	# With the docker folder:/var/log/apache2
	# Test
	#sudo docker run --name=webpocketinnocity -v /etc/pocketinnocity/logs:/var/log/apache2 -it -p 8080:80 -p 8443:443 web
	sudo docker run --name=webpocketinnocity -v /etc/pocketinnocity/logs:/var/log/apache2 -d -p 8080:80 -p 8443:443 web

	# Build CrowdSec replacement of fail2ban
	cd $(PWD)/crowdsec; \
	sudo docker build -t crowdsec .

	# Run
	sudo touch /etc/pocketinnocity/db/crowdsec.db
	sudo docker run -d \
		-v $(PWD)/crowdsecurity/config/config.yaml:/etc/crowdsec/config.yaml \
		-v $(PWD)/crowdsecurity/config/acquis.yaml:/etc/crowdsec/acquis.yaml \
		-v /etc/pocketinnocity/logs:/logs \
		-v /etc/pocketinnocity/db/crowdsec.db:/var/lib/crowdsec/data/crowdsec.db \
		-v $(PWD)/crowdsecurity/collections/pocketinnocity/modsecurity.yaml:/etc/crowdsec/collections/pocketinnocity/modsecurity.yaml \
		-v $(PWD)/crowdsecurity/parsers/pocketinnocity/modsecurity.yaml:/etc/crowdsec/parsers/pocketinnocity/modsecurity.yaml \
		-v $(PWD)/crowdsecurity/scenarios/pocketinnocity/modsecurity.yaml:/etc/crowdsec/scenarios/pocketinnocity/modsecurity.yaml \
		-e COLLECTIONS="pocketinnocity/modsecurity" \
		-p 8888:8080 -p 6060:6060 \
		--name crowdsec crowdsecurity/crowdsec

clean:
	sudo docker stop webpocketinnocity
	sudo docker rm webpocketinnocity
	sudo docker stop crowdsec
	sudo docker rm crowdsec
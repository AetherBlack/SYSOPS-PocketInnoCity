# TODO

## Docker

Setup CrowdSec instead of fail2ban.
Create scenario for modsecurity and maybe apache2 if possible.

Docs: <https://docs.crowdsec.net/Crowdsec/v1/write_configurations/requirements/>

Code: <https://github.com/crowdsecurity/crowdsec>

### Setup modsecurity custom collection for CrowdSec

Collections model: <https://github.com/crowdsecurity/hub/blob/master/collections/crowdsecurity/modsecurity.yaml>

Parser model: <https://github.com/crowdsecurity/hub/blob/master/parsers/s01-parse/crowdsecurity/modsecurity.yaml>

Scenarios: <https://github.com/crowdsecurity/hub/blob/master/scenarios/crowdsecurity/modsecurity.yaml>

## PHP

Desactivate shell functions like `system`, `shell_exec` and other...
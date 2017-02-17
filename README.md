# idOS-Queue

Handles all requests to scrape, feature, email, sms and cra daemons (handlers).

## Manuals

The operation manual can be found [here](Operations.md).

The setup manual can be found [here](Setup.md).

## Documentation

To generate the internal documentation, run:

```bash
./vendor/bin/phploc --log-xml=build/phploc.xml app/
./vendor/bin/phpmd app/ xml cleancode,codesize,controversial,design,naming,unusedcode --reportfile build/pmd.xml
./vendor/bin/phpcs --standard=VeriduRuleset.xml --report=xml --report-file=build/phpcs.xml app/
./vendor/bin/phpdox --file phpdox.xml.dist
```

The files will be stored at [docs/](docs/).

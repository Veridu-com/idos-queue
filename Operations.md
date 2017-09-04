# Operations

## Running

In order to start the Queue application you can run in the terminal:

```
php -S 127.0.0.1:8080 -t public/index.php
```

You can then open `http://localhost:8080/` on your browser.

## Dependencies

This application relies on [Gearman](http://gearman.org/) for queueing tasks and acts as gateway for all handlers.

## Handler Projects

- [Scrape Handler](https://github.com/veridu/idos-scrape-handler)
- [Feature Handler](https://github.com/veridu/idos-feature-handler)
- [E-mail Handler](https://github.com/veridu/idos-email-handler)
- [SMS Handler](https://github.com/veridu/idos-sms-handler)
- [CRA Handler](https://github.com/veridu/idos-cra-handler)

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

- [Scrape Handler](https://bitbucket.org/veridu/idos-scrape-handler)
- [Feature Handler](https://bitbucket.org/veridu/idos-feature-handler)
- [E-mail Handler](https://bitbucket.org/veridu/idos-email-handler)
- [SMS Handler](https://bitbucket.org/veridu/idos-sms-handler)
- [CRA Handler](https://bitbucket.org/veridu/idos-cra-handler)

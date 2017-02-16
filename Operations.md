# Operations

## Running

In order to start the Queue application you can run in the terminal:

```
php -S 127.0.0.1:8080 -t public/index.php
```

You can then open `http://localhost/` on your browser.

## Dependencies

This application relies on [Gearman](http://gearman.org/) for queueing tasks.

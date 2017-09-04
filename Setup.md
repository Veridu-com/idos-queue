# Setup

## Dependencies Install

This project uses [composer](https://getcomposer.org/) for dependency management.

In order to install the required dependencies to run the daemon, just run in the project root:

```
composer install
```

## Settings

You need to set some environment variables in order to configure the Queue application, such as in the following example:

* `IDOS_VERSION`: indicates the version of idOS API to use (default: '1.0');
* `IDOS_DEBUG`: indicates whether to enable debugging (default: false);
* `IDOS_LOG_FILE`: is the path for the generated log file (default: 'log/api.log');
* `IDOS_GEARMAN_SERVERS`: a list of gearman servers that the daemon will register on (default: 'localhost:4730');
* `IDOS_SCRAPE_USER`: the Scrape daemon basic authentication user;
* `IDOS_SCRAPE_PASS`: the Scrape daemon basic authentication password;
* `IDOS_FEATURE_USER`: the Feature daemon basic authentication user;
* `IDOS_FEATURE_PASS`: the Feature daemon basic authentication password;
* `IDOS_EMAIL_USER`: the Email daemon basic authentication user;
* `IDOS_EMAIL_PASS`: the Email daemon basic authentication password;
* `IDOS_SMS_USER`: the SMS daemon basic authentication user;
* `IDOS_SMS_PASS`: the SMS daemon basic authentication password;
* `IDOS_CRA_USER`: the CRA daemon basic authentication user;
* `IDOS_CRA_PASS`: the CRA daemon basic authentication password.

You may also set these variables using a `.env` file in the project root.

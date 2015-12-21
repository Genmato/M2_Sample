Genmato Sample extension for Magento2
====

This is a small Magento2 sample extension using various functions like:

* Model/Resource model for database access
* Schema and Data setup/upgrade script
* Frontend router with layout/template
* Backend router
* Backend grid with mass-action, search and delete/edit actions
* Backend form to edit/create records

Installation
====

This package is registered on [Packagist](https://packagist.org/packages/genmato/sample) for easy installation. In your Magento installation root run:

`composer require genmato/sample`

This will install the latest version in your Magento installation, when completed run:

```
php bin/magento module:enable Genmato_Sample

php bin/magento setup:upgrade

php bin/magento cache:clean
```

This will enable the extension and run the Schema and Data scripts to create the database and insert a sample record.

(C)2015 Genmato BV, The Netherlands.
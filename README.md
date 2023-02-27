The module integrates a Magento 2 based webstore with [TBC Bank](http://www.tbcbank.ge) (Georgia).  
The module is **free** and **open source**.

![](https://mage2.pro/uploads/default/original/2X/3/312d322286b2a474fb76ab5a539dfb14698a6497.png)
![](https://mage2.pro/uploads/default/original/2X/0/0aaf74161960c5d37cdfb955421a5a586d72789a.png)
![](https://mage2.pro/uploads/default/original/2X/8/8d11867a6f0b1e8920a9c5d342e24a1c7cfe5fb3.png)
![](https://mage2.pro/uploads/default/original/2X/8/8070c57ea9dbc39570110b4a39a5c8998452b104.png)

## How to install
[Hire me in Upwork](https://upwork.com/fl/mage2pro), and I will: 
- install and configure the module properly on your website
- answer your questions
- solve compatiblity problems with third-party checkout, shipping, marketing modules
- implement new features you need 

### 2. Self-installation
```
bin/magento maintenance:enable
rm -f composer.lock
composer clear-cache
composer require mage2pro/tbc-bank:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy -f ka_GE en_US <additional locales, e.g.: ru_RU>
bin/magento maintenance:disable
```

## How to update
```
bin/magento maintenance:enable
composer remove mage2pro/tbc-bank
rm -f composer.lock
composer clear-cache
composer require mage2pro/tbc-bank:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy -f ka_GE en_US <additional locales, e.g.: ru_RU>
bin/magento maintenance:disable
```
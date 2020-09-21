This extension integrates a Magento 2 based webstore with [TBC Bank](http://www.tbcbank.ge) (Georgia).

![](https://mage2.pro/uploads/default/original/2X/3/312d322286b2a474fb76ab5a539dfb14698a6497.png)

![](https://mage2.pro/uploads/default/original/2X/0/0aaf74161960c5d37cdfb955421a5a586d72789a.png)

![](https://mage2.pro/uploads/default/original/2X/8/8d11867a6f0b1e8920a9c5d342e24a1c7cfe5fb3.png)

![](https://mage2.pro/uploads/default/original/2X/8/8070c57ea9dbc39570110b4a39a5c8998452b104.png)

## How to install
Hire me in Upwork to install the module: [upwork.com/fl/mage2pro](https://www.upwork.com/fl/mage2pro)

### 2. Self-installation
```
bin/magento maintenance:enable
composer clear-cache
composer require mage2pro/tbc-bank:*
bin/magento setup:upgrade
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
rm -rf pub/static/* && bin/magento setup:static-content:deploy ka_GE en_US <additional locales, e.g.: ru_RU>
bin/magento maintenance:disable
```
If you have problems with these commands, please check the [detailed instruction](https://mage2.pro/t/263).

## How to update
```
bin/magento maintenance:enable
composer clear-cache
composer update mage2pro/tbc-bank
bin/magento setup:upgrade
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
rm -rf pub/static/* && bin/magento setup:static-content:deploy ka_GE en_US <additional locales, e.g.: ru_RU>
bin/magento maintenance:disable
```

## Support
Hire me in Upwork to solve your problems with the module: [upwork.com/fl/mage2pro](https://www.upwork.com/fl/mage2pro)
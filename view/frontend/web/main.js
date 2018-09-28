// 2018-09-28
define([
	'df', 'df-lodash', 'Df_Checkout/api'
	,'Df_StripeClone/main', 'jquery', 'ko'
	,'Magento_Checkout/js/model/quote'
	,'Magento_Customer/js/model/customer'
	,'Magento_Checkout/js/model/url-builder'
], function(df, _, api, parent, $, ko, q, customer, ub) {'use strict';
/** 2017-09-06 @uses Class::extend() https://github.com/magento/magento2/blob/2.2.0-rc2.3/app/code/Magento/Ui/view/base/web/js/lib/core/class.js#L106-L140 */
return parent.extend({
	/**
	 * 2018-09-29 https://ecommerce.ufc.ge/ecomm2/images/ufc-utils_v2.js
	 * @override
	 * @see Df_Payment/main::getCardTypes()
	 * @used-by https://github.com/mage2pro/core/blob/3.9.12/Payment/view/frontend/web/template/card/fields.html#L4
	 * @returns {String[]}
	 */
	getCardTypes: function() {return ['VI', 'MC', 'MI'];},
    /**
	 * 2018-09-29
	 * @override
	 * @see Df_StripeClone/main::tokenCheckStatus()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L8-L15
	 * @used-by Df_StripeClone/main::placeOrder()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L75
	 * @param {Boolean} status
	 * @returns {Boolean}
	 */
	tokenCheckStatus: function(status) {return status;},
    /**
	 * 2018-09-29
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L21-L29
	 * @used-by Df_StripeClone/main::placeOrder()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L73
	 * @param {Object} params
	 * @param {Function} callback
	 */
	tokenCreate: function(params, callback) {
		// 2017-04-04
		// The M2 client part does not notify the server part about the billing address change.
		// So we need to pass the chosen country ID to the server part.
		//console.log(newAddress.countryId);
		//_this.klHtml(newAddress.countryId);
		/** @type {Boolean} */ var l = customer.isLoggedIn();
		$.when(api(this,
			// 2017-04-05, 2018-09-28
			// q.getQuoteId() is a string like «63b25f081bfb8e4594725d8a58b012f7» for guests.
			ub.createUrl(df.s.t('/dfe-tbc-bank/%s/id', l ? 'mine' : q.getQuoteId()), {})
			,_.assign({ba: q.billingAddress(), qp: this.getData()}, l ? {} : {email: q.guestEmail})
		))
			.fail(function() {debugger; callback(false, null);})
			.done($.proxy(function(json) {
				callback(true, $.parseJSON(json));
			}, this))
		;
	},
    /**
	 * 2017-02-16
	 * https://www.omise.co/omise-js-api#createtoken(type,-object,-callback)
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L31-L39
	 * @used-by placeOrder()
	 * @param {Object|Number} status
	 * @param {Object} resp
	 * @returns {String}
	 */
	tokenErrorMessage: function(status, resp) {return this.$t(
		'The payment attempt is failed. Please contact us by phone.'
	);},
    /**
	 * 2018-09-29
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L41-L48
	 * @used-by placeOrder()
	 * @param {Object} resp
	 * @returns {String}
	 */
	tokenFromResponse: function(resp) {return resp.id;},
});});
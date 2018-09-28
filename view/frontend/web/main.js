// 2018-09-28
define([
	'df', 'df-lodash', 'Df_Checkout/api'
	,'Df_Payment/custom', 'jquery', 'ko'
	,'Magento_Checkout/js/model/quote'
	,'Magento_Customer/js/model/customer'
	,'Magento_Checkout/js/model/url-builder'
], function(df, _, api, parent, $, ko, q, customer, ub) {'use strict';
/** 2017-09-06 @uses Class::extend() https://github.com/magento/magento2/blob/2.2.0-rc2.3/app/code/Magento/Ui/view/base/web/js/lib/core/class.js#L106-L140 */
return parent.extend({
	defaults: {df: {formTemplate: 'Dfe_TBCBank/main'}},
	/**
	 * 2018-09-28
	 * @override
	 * @see Df_Payment/card::initialize()
	 * https://github.com/mage2pro/core/blob/2.4.21/Payment/view/frontend/web/card.js#L77-L110
	 * @returns {exports}
	*/
	initialize: function() {
		this._super();
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
			.fail(function() {debugger;})
			.done($.proxy(function(json) {
				// 2017-04-05 Отныне json у нас всегда строка: @see dfw_encode().
				/** @type {Object} */
				var d = !json ? {} : $.parseJSON(json);
				var $iframe = $('<iframe></iframe>').attr({
					frameborder: 0
					,height: 580
					,src: 'https://ecommerce.ufc.ge/ecomm2/ClientHandler?trans_id=' + encodeURIComponent(d['id'])
					,scrolling: 'no'
					,width: 400
				});
				// 2018-09-28 «Detect redirect in iFrame»: https://stackoverflow.com/a/10301551
				var c = 0;
				$iframe.load(function() {
					if (1 < ++c) {
						console.log('redirected: ' + c);
					}
				});
				this.dfForm().append($iframe);
			}, this))
		;
		return this;
	}
});});
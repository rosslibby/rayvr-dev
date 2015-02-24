<?php
return [
	/**
	 * Credentials
	 */
	'client_id' => 'AYlbChCk7mTzAcQD1u_rxLr4KB0PNE9QhmJU6Gmfh_9scFyzoeGiCckcfQsy',
	'secret' => 'EGmHiRAE1KdRZqBIkphWz5NfNkPKwgHu6nHz_MQkTuEcaQ-Kmf-AqhmImrUr',

	/**
	 * SDK configuration
	 */
	'settings' => [
		/**
		 * Available option 'sandbox' or 'live'
		 */
		'mode' => 'sandbox',

		/**
		 * Specify the max request time in seconds
		 */
		'http.ConnectionTimeOut' => 30,

		/**
		 * Whether want to log to a file
		 */
		'log.LogEnabled' => true,

		/**
		 * Specify the file that we want to write on
		 */
		'log.FileName' => storage_path() . '/logs/paypal.log',

		/**
		 * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
		 * 
		 * Logging is most verbose in the 'FINE' level and decreases as you
		 * proceed towards ERROR
		 */
		'log.LogLevel' => 'FINE'
	],
];
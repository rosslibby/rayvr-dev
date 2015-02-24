<?php 

return [
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => [

		/**
		 * Facebook
		 */
        'Facebook' => [
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => [],
        ],

        /**
         * PayPal
         */
        'Paypal' => [
        	'client_id'		=> 'AYlbChCk7mTzAcQD1u_rxLr4KB0PNE9QhmJU6Gmfh_9scFyzoeGiCckcfQsy',
        	'client_secret'	=> 'EGmHiRAE1KdRZqBIkphWz5NfNkPKwgHu6nHz_MQkTuEcaQ-Kmf-AqhmImrUr',
        	'grant_type' => 'authorization_code',
        	'scope'			=> ['profile', 'openid'],
        ],
	]

];
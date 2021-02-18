<?php
return array(
    // set your paypal credential
    'client_id' => 'ASDSvvj1h-rN5UA0zx99XzsUidQecdHYKeh-7bWUMADGA6lgd5pKTqOc9NAJBDHBFdChkGsvwq7tNFkT',
    'secret' => 'EAEbPKu48ia5U8achjRTx9DqRAXPJPjuhysU1woNfNZKXngyUcxG4qxJU3d2zjZO04kTZxS-RLd7Ovwe',

    /**
     * SDK configuration 
     */
    'settings' => array(
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
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'INFO'
    ),
);
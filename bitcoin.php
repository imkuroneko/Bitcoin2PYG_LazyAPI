<?php
	// Local Timezone
	date_default_timezone_set('America/Asuncion');

	// Get content functions
	function coinbase() {
		$cb_json = "https://coinbase.com/api/v1/currencies/exchange_rates";
		$json = json_decode(file_get_contents($cb_json));
		$current_price = $json->btc_to_usd;
		return usd2pyg($current_price);
	}

	function coincap() {
		$cb_json = "https://coincap.io/page/BTC";
		$json = json_decode(file_get_contents($cb_json));
		$current_price = $json->price_usd;
		return usd2pyg($current_price);
	}

	function bitstamp() {
		$bs_json = "https://www.bitstamp.net/api/ticker/";
		$json = json_decode(file_get_contents($bs_json));
		$current_price = $json->last;
		return usd2pyg($current_price);
	}
	
	function blockchain() {
		$bc_json = "https://blockchain.info/ticker";
		$json = json_decode(file_get_contents($bc_json));
		$current_price = $json->USD->last;
		return usd2pyg($current_price);
	}
	
	function xapo() {
		$xp_json = "https://api.xapo.com/v3/quotes/USDBTC";
		$json = json_decode(file_get_contents($xp_json));
		$current_price = $json->fx_etoe->USDBTC->source_amt;
		return usd2pyg($current_price);
	}

	function bitfinex() {
		$cb_json = "https://api.bitfinex.com/v1/ticker/btcusd";
		$json = json_decode(file_get_contents($cb_json));
		$current_price = $json->last_price;
		return usd2pyg($current_price);
	}

	function bitexla() {
		$xp_json = "https://bitex.la/api-v1/rest/btc_usd/market/ticker";
		$json = json_decode(file_get_contents($xp_json));
		$current_price = $json->last;
		return usd2pyg($current_price);
	}

	function kraken() {
		$cb_json = "https://api.kraken.com/0/public/Ticker?pair=XBTUSD";
		$json = json_decode(file_get_contents($cb_json));
		$current_price = $json->result->XXBTZUSD->c[0];
		return usd2pyg($current_price);
	}

	// Get current exchange (USD to PYG) from MaxiCambios
	function usd2pyg($value) {
		$xml = "http://cotizext.maxicambios.com.py/maxicambios.xml";
		$info = file_get_contents($xml);
		preg_match_all('%<venta>(.*?)</venta>%i', $info, $usd_sell);
		$usd = $usd_sell[1][0];

		return number_format($value * $usd, 0, '', '.');
	}
	
	// Create array
	$cotizacion = array(
		'coinbase'		=> coinbase(),
		'bitstamp'		=> bitstamp(),
		'blockchain'	=> blockchain(),
		'xapo'			=> xapo(),
		'coincap'		=> coincap(),
		'bitfinex'		=> bitfinex(),
		'bitexla'		=> bitexla(),
		'kraken'		=> kraken(),
		'last-update'   => date("d-m-Y H:i:s")
	);

	// Create/Open our json "api" file
    fopen('bitcoin-price.json', 'w');

	// Load content from array
    file_put_contents('bitcoin-price.json', json_encode($cotizacion));
?>

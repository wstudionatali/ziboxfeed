<?php
/* zibox_log('note', $var); */
if (!function_exists('zibox_log')) {

    function zibox_log($label = '', $log = '') {
						
		 $handle = fopen(ZIBOX_PATH . '/logs/error.log', 'a');
		 if ($label) {
		 fwrite($handle, date('Y-m-d G:i:s') . ' - ' . print_r($label, true) . "\n"); }
		 if ($log) {
		fwrite($handle, date('Y-m-d G:i:s') . ' - ' . print_r($log, true) . "\n");	}
		fclose($handle);
}
}
?>
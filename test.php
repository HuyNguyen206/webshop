<?php
//$a = unserialize('{"api_version":"2024-04-10","created":1718694624,"data":{"object":{"amount":1054296,"amount_capturable":0,"amount_details":{"tip":{}},"amount_received":0,"application":null,"application_fee_amount":null,"automatic_payment_methods":null,"canceled_at":null,"cancellation_reason":null,"capture_method":"automatic","client_secret":"pi_3PSwBQJSpWIbVxO52pPrWJDr_secret_CTorR1yeWblIaFSyOhJLazCK1","confirmation_method":"automatic","created":1718694624,"currency":"usd","customer":"cus_QJX0Tw8FrCR4qi","description":null,"id":"pi_3PSwBQJSpWIbVxO52pPrWJDr","invoice":null,"last_payment_error":null,"latest_charge":null,"livemode":false,"metadata":{},"next_action":null,"object":"payment_intent","on_behalf_of":null,"payment_method":null,"payment_method_configuration_details":null,"payment_method_options":{"card":{"installments":null,"mandate_options":null,"network":null,"request_three_d_secure":"automatic"}},"payment_method_types":["card"],"processing":null,"receipt_email":null,"review":null,"setup_future_usage":null,"shipping":null,"source":null,"statement_descriptor":null,"statement_descriptor_suffix":null,"status":"requires_payment_method","transfer_data":null,"transfer_group":null}},"id":"evt_3PSwBQJSpWIbVxO52ILqYQQ8","livemode":false,"object":"event","pending_webhooks":2,"request":{"id":"req_aTkDvgzVnYfMLm","idempotency_key":"d99f57f5-0666-41df-aced-62ed8d79c406"},"type":"payment_intent.created"}');
//var_dump($a);
$a = json_decode('{"api_version":"2024-04-10","created":1718694624,"data":{"object":{"amount":1054296,"amount_capturable":0,"amount_details":{"tip":{}},"amount_received":0,"application":null,"application_fee_amount":null,"automatic_payment_methods":null,"canceled_at":null,"cancellation_reason":null,"capture_method":"automatic","client_secret":"pi_3PSwBQJSpWIbVxO52pPrWJDr_secret_CTorR1yeWblIaFSyOhJLazCK1","confirmation_method":"automatic","created":1718694624,"currency":"usd","customer":"cus_QJX0Tw8FrCR4qi","description":null,"id":"pi_3PSwBQJSpWIbVxO52pPrWJDr","invoice":null,"last_payment_error":null,"latest_charge":null,"livemode":false,"metadata":{},"next_action":null,"object":"payment_intent","on_behalf_of":null,"payment_method":null,"payment_method_configuration_details":null,"payment_method_options":{"card":{"installments":null,"mandate_options":null,"network":null,"request_three_d_secure":"automatic"}},"payment_method_types":["card"],"processing":null,"receipt_email":null,"review":null,"setup_future_usage":null,"shipping":null,"source":null,"statement_descriptor":null,"statement_descriptor_suffix":null,"status":"requires_payment_method","transfer_data":null,"transfer_group":null}},"id":"evt_3PSwBQJSpWIbVxO52ILqYQQ8","livemode":false,"object":"event","pending_webhooks":2,"request":{"id":"req_aTkDvgzVnYfMLm","idempotency_key":"d99f57f5-0666-41df-aced-62ed8d79c406"},"type":"payment_intent.created"}');
$b = serialize($a);
$c = unserialize($b);

var_dump($b);

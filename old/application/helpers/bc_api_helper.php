<?php if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}
function getData($url_filter)
{
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL =>$url_filter,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 200,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);

  $result1 = curl_exec($curl);
//   echo "cURL Error #:" . curl_error($curl);
  curl_close($curl);
  return $result1;
}


function getAllData($url_filter)
{
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" . STOREHASH . "/v3/" . $url_filter,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 200,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);

  $result1 = curl_exec($curl);
  // echo "cURL Error #:" . curl_error($curl);
  curl_close($curl);
  return $result1;
}

function getAllblogs()
{
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" . STOREHASH . "/v2/blog/posts",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 200,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "Accept: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);

  $result1 = curl_exec($curl);
  // echo "cURL Error #:" . curl_error($curl);
  curl_close($curl);
  return $result1;
}
function getablog($id)
{
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" . STOREHASH . "/v2/blog/posts/".$id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 200,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "Accept: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);

  $result1 = curl_exec($curl);
  // echo "cURL Error #:" . curl_error($curl);
  curl_close($curl);
  return $result1;
}

function createcart($product_array)
{
  $curl = curl_init();
  $product = json_encode($product_array);
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" . STOREHASH . "/v3/carts",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $product,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function updatecart($cartid, $product_array)
{
  $curl = curl_init();
  $product = json_encode($product_array);
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" .
      STOREHASH .
      "/v3/carts/" .
      $cartid .
      "/items",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $product,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}
function updatecart_customer($cartid, $customer_id)
{
  $curl = curl_init();
  $cust_id = json_encode($customer_id);
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" .
      STOREHASH .
      "/v3/carts/" .
      $cartid,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => $cust_id,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}
function updatecheckout($cart_id, $add, $variable, $method)
{
  $curl = curl_init();
  $product = json_encode($add);
  $url =
    "https://api.bigcommerce.com/stores/" .
    STOREHASH .
    "/v3/checkouts/" .
    $cart_id .
    "/" .
    $variable;
  // echo $url;
  // print_R($product);
  curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_POSTFIELDS => $product,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}
function create_order($cart_id)
{
  $curl = curl_init();
  $url =
    "https://api.bigcommerce.com/stores/" .
    STOREHASH .
    "/v3/checkouts/" .
    $cart_id .
    "/orders";

  curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}
function updatebilling($cart_id, $add)
{
  $curl = curl_init();
  $address = json_encode($add);
  $url =
    "https://api.bigcommerce.com/stores/" .
    STOREHASH .
    "/v3/checkouts/" .
    $cart_id .
    "/billing-address";
  // echo $url;
  // print_R($address);
  curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $address,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function updatecustomeraddress($add)
{
  $curl = curl_init();
  $address = json_encode($add);
  $url =
    "https://api.bigcommerce.com/stores/" .
    STOREHASH .
    "/v3/customers/addresses";
  // echo $url;
  print_R($address);
  curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "[" . $address . "]",
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

// function deletecustomeraddress($cust_id)
// {
//     $curl = curl_init();
//     $url = "https://api.bigcommerce.com/stores/" . STOREHASH . "/v3/customers/addresses";
//     // echo $url;
//     curl_setopt_array($curl, [
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 30,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "DELETE",
//         CURLOPT_HTTPHEADER => [
//             "Content-Type: application/json",
//             "X-Auth-Token: " . AUTHTOKEN
//         ],
//     ]);
//     $response = curl_exec($curl);
//     $err = curl_error($curl);
//     curl_close($curl);
//     if ($err) {
//         return "cURL Error #:" . $err;
//     } else {
//         return $response;
//     }
// }

function delete_cart($cart_id)
{
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" .
      STOREHASH .
      "/v3/carts/" .
      $cart_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function createcustomer($user_array)
{
  $curl = curl_init();
  $user = json_encode([
    "email" => $user_array['email'],
    "first_name" => $user_array['first_name'],
    "last_name" => $user_array['last_name'],
    "company" => "",
    "phone" => $user_array['phone'],
    "notes" => "",
    "tax_exempt_category" => "",
    "customer_group_id" => 0,
    "authentication" => [
      "force_password_reset" => false,
      "new_password" => $user_array['password'],
    ],
    "origin_channel_id" => 1,
    "channel_ids" => [1],
  ]);
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" . STOREHASH . "/v3/customers",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "[" . $user . "]",
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function logincustomer($post)
{
  $curl = curl_init();
  $arr = [
    "email" => $post['email'],
    "password" => $post['password'],
    "channel_id" => 1,
  ];
  $user = json_encode($arr);
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" .
      STOREHASH .
      "/v3/customers/validate-credentials",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $user,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);

  $result1 = curl_exec($curl);
  curl_close($curl);
  return $result1;
}
function payment($order_id)
{
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" .
      STOREHASH .
      "/v3/payments/methods?order_id=" .
      $order_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}
function create_access_token($order_id)
{
  $curl = curl_init();
  $details = array("order" => array("id" => $order_id, "is_recurring" => false));
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" .
      STOREHASH .
      "/v3/payments/access_tokens",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($details),
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}
function process_payment($auth,$pay_details)
{
 
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://payments.bigcommerce.com/stores/".STOREHASH ."/payments",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($pay_details),
  CURLOPT_HTTPHEADER => [
    "Accept: application/vnd.bc.v1+json",
    "Authorization: PAT ".$auth,
    "Content-Type: application/json",
    "X-Auth-Token: " . AUTHTOKEN,
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}
}
function get_order_list($cid)
{
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.bigcommerce.com/stores/".STOREHASH ."/v2/orders?customer_id=".$cid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "X-Auth-Token: " . AUTHTOKEN,
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}
}
function order_status($order_id,$status_id)
{
  $curl = curl_init();
  $status = json_encode(array('status_id'=>$status_id));
  curl_setopt_array($curl, [
    CURLOPT_URL =>
      "https://api.bigcommerce.com/stores/" .
      STOREHASH .
      "/v2/orders/" .
      $order_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => $status,
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-Auth-Token: " . AUTHTOKEN,
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}
function save_review($product_id,$review)
{
    $curl = curl_init();
    print_R($review);
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.bigcommerce.com/stores/" .
          STOREHASH .
          "/v3/catalog/products/" .
          $product_id .
          "/reviews",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($review),
      CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Content-Type: application/json",
        "X-Auth-Token: " . AUTHTOKEN,
      ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      return "cURL Error #:" . $err;
    } else {
      return $response;
    }
}
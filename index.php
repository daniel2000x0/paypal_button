<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> PayPal Checkout Integration | Server Demo </title>
    <link rel="stylesheet" type="text/css" href="css.css" />
</head>

<body>
    <!-- Set up a container element for the button -->
    <div class="container">
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    </div>
    <script>
    paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                reference_id: "PUHF",
                description: "Sporting Goods",

                custom_id: "CUST-HighFashions",
                soft_descriptor: "HighFashions",
                amount: {
                    currency_code: "USD",
                    value: "230.00",
                    breakdown: {
                        item_total: {
                            currency_code: "USD",
                            value: "180.00"
                        },
                        shipping: {
                            currency_code: "USD",
                            value: "30.00"
                        },
                        handling: {
                            currency_code: "USD",
                            value: "10.00"
                        },
                        tax_total: {
                            currency_code: "USD",
                            value: "20.00"
                        },
                        shipping_discount: {
                            currency_code: "USD",
                            value: "10"
                        }
                    }
                },
                items: [{
                    name: "T-Shirt",
                    description: "Green XL",
                    sku: "sku01",
                    unit_amount: {
                         currency_code: "USD",
                         value: "90.00"
                    },
                    tax: {
                        currency_code: "USD",
                        value: "10.00"
                    },
                    quantity: "1",
                    category: "PHYSICAL_GOODS"
                },
                    {
                    name: "Shoes",
                    description: "Running, Size 10.5",
                    sku: "sku02",
                    unit_amount: {
                         currency_code: "USD",
                         value: "45.00"
                    },
                    tax: {
                        currency_code: "USD",
                        value: "5.00"
                    },
                    quantity: "2",
                    category: "PHYSICAL_GOODS"
                }
                ],
                shipping: {
                    method: "United States Postal Service",
                    address: {
                        name: {
                            full_name: "John",
                            surname: "Doe"
                        },
                        address_line_1: "123 Townsend St",
                        address_line_2: "Floor 6",
                        admin_area_2: "San Francisco",
                        admin_area_1: "CA",
                        postal_code: "94107",
                        country_code: "US"
                    }
                }
            }]
        })
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name)
            // Call your server to save the transaction
            return fetch('/api/paypal-transaction-complete', {
                method: 'post',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    orderID: data.orderID
                })
            })
        })
    }
}).render('#paypal-button-container')
   
   
   function buttonpaypal(total){
    
   }
   </script>
</body>

</html>
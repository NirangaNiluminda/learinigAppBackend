{{-- <!DOCTYPE html>

<html>

<head>
    <title>
        Thank you for Order!!
    </title>
    <link rel="stylesheet" href="css/style.css">
    <script src='js/client.js' defer></script>
    <meta name="viewpoint" content="width=device-width, initial-scale=1">


</head>

<body>
    <section>
        <div class="product Box-root">
            <svg xmlns = "http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/" >
            <defs/>
            <g id="Flow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="0-default"transform="translate(-121.000000,-40.000000)" >
                    <path d="M121 40L121 60C121 61.1046 120.1046 62 119 62H111C109.8954 62 109 61.1046 109 60L109 40C109 38.8954 110.8954 38 112 38H119C120.1046 38 121 38.8954 121 40Z" fill="#FF2D20"/>
                </g>
            </g>
        </svg>
        <div class = "description Box-root">
            <h3> Your Payment was scucceefull</h3>
        </div>
        </div>
        <button id="checkout-and-portal-button" onclick="postMessage();">Go Back</button>
    </section>
</body>
<script type= 'text/javascript'>
function postMassage(){
    Pay.postMassage('success');
}

</script>
</html> --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thank You for Your Order!</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/client.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <section>
        <div class="product Box-root">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="54" height="57" viewBox="0 0 20 20">
                <defs />
                <g id="Flow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="0-default" transform="translate(-121.000000,-40.000000)">
                        <path d="M121 40L121 60C121 61.1046 120.1046 62 119 62H111C109.8954 62 109 61.1046 109 60L109 40C109 38.8954 110.8954 38 112 38H119C120.1046 38 121 38.8954 121 40Z" fill="#FF2D20"/>
                    </g>
                </g>
            </svg>
            <div class="description Box-root">
                <h3>Your Payment was Successful</h3>
            </div>
        </div>
        <button id="checkout-and-portal-button" onclick="postMessage();">Go Back</button>
    </section>

    <script type="text/javascript">
        function postMessage() {
            Pay.postMessage('success');
        }
    </script>
</body>

</html>

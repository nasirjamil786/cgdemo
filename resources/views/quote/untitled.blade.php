<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-------------------------------
  ___  _   _    _            
 /   || | | |  | |           
 \__  | | | |  | |  __       
 /    |/  |/_) |/  /  \_/\/  
 \___/|__/| \_/|__/\__/  /\_/
               |\            
               |/            

Cam @ Elkfox.com
http://experts.shopify.com/elkfox
-------------------------------->

<!-------------------------------

NOTES:

When you are ready to add this to your Shopify site. You should use http://zurb.com/ink/inliner.php to "inline" your code, so it works in email apps.

-------------------------------->

<head>
<meta name="viewport" content="width=device-width" /><!-- IMPORTANT -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Order Confirmed</title>
    
<!-- <link rel="stylesheet" type="text/css" href="stylesheets/email.css" /> -->
<style>
    /* ------------------------------------- 
            GLOBAL 
    ------------------------------------- */
    * { 
        margin:0;
        padding:0;
    }
    * { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }
    
    img { 
        max-width: 100%; 
    }
    .collapse {
        margin:0;
        padding:0;
    }
    body {
        -webkit-font-smoothing:antialiased; 
        -webkit-text-size-adjust:none; 
        width: 100%!important; 
        height: 100%;
    }
    
    
    /* ------------------------------------- 
            ELEMENTS 
    ------------------------------------- */
    a { color: #2BA6CB;}
    
    .btn {
        text-decoration:none;
        color:#FFF;
        background-color:#666;
        width:80%;
        padding:15px 10%;
        font-weight:bold;
        text-align:center;
        cursor:pointer;
        display:inline-block;
    }
    
    p.callout {
        padding:15px;
        text-align:center;
        background-color:#ECF8FF;
        margin-bottom: 15px;
    }
    .callout a {
        font-weight:bold;
        color: #2BA6CB;
    }
    
    .column table { width:100%;}
    .column {
        width: 300px;
        float:left;
    }
    .column tr td { padding: 15px; }
    .column-wrap { 
        padding:0!important; 
        margin:0 auto; 
        max-width:600px!important;
    }
    .columns .column {
        width: 280px;
        min-width: 279px;
        float:left;
    }
    table.columns, table.column, .columns .column tr, .columns .column td {
        padding:0;
        margin:0;
        border:0;
        border-collapse:collapse;
    }
    
    /* ------------------------------------- 
            HEADER 
    ------------------------------------- */
    table.head-wrap { width: 100%;}
    
    .header.container table td.logo { padding: 15px; }
    .header.container table td.label { padding: 15px; padding-left:0px;}
    
    
    /* ------------------------------------- 
            BODY 
    ------------------------------------- */
    table.body-wrap { width: 100%;}
    
    
    /* ------------------------------------- 
            FOOTER 
    ------------------------------------- */
    table.footer-wrap { width: 100%;    clear:both!important;
    }
    .footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
    .footer-wrap .container td.content p {
        font-size:10px;
        font-weight: bold;
        
    }
    
    
    /* ------------------------------------- 
            TYPOGRAPHY 
    ------------------------------------- */
    h1,h2,h3,h4,h5,h6 {
    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
    }
    h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }
    
    h1 { font-weight:200; font-size: 44px;}
    h2 { font-weight:200; font-size: 37px;}
    h3 { font-weight:500; font-size: 27px;}
    h4 { font-weight:500; font-size: 23px;}
    h5 { font-weight:900; font-size: 17px;}
    h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}
    
    .collapse { margin:0!important;}
    
    p, ul { 
        margin-bottom: 10px; 
        font-weight: normal; 
        font-size:14px; 
        line-height:1.6;
    }
    p.lead { font-size:17px; }
    p.last { margin-bottom:0px;}
    
    ul li {
        margin-left:5px;
        list-style-position: inside;
    }
    
    hr {
        border: 0;
        height: 0;
        border-top: 1px dotted rgba(0, 0, 0, 0.1);
        border-bottom: 1px dotted rgba(255, 255, 255, 0.3);
    }
    
    
    /* ------------------------------------- 
            Shopify
    ------------------------------------- */

    .products {
        width:100%;
        height:40px;
        margin:10px 0 10px 0;
    }
    .products img {
        float:left;
        height:40px;
        width:auto;
        margin-right:20px;
    }
    .products span {
        font-size:17px;
    }
    
    
    /* --------------------------------------------------- 
            RESPONSIVENESS
            Nuke it from orbit. It's the only way to be sure. 
    ------------------------------------------------------ */
    
    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
    .container {
        display:block!important;
        max-width:600px!important;
        margin:0 auto!important; /* makes it centered */
        clear:both!important;
    }
    
    /* This should also be a block element, so that it will fill 100% of the .container */
    .content {
        padding:15px;
        max-width:600px;
        margin:0 auto;
        display:block; 
    }
    
    /* Let's make sure tables in the content area are 100% wide */
    .content table { width: 100%; }
    
    /* Be sure to place a .clear element after each set of columns, just to be safe */
    .clear { display: block; clear: both; }
    
    
    /* ------------------------------------------- 
            PHONE
            For clients that support media queries.
            Nothing fancy. 
    -------------------------------------------- */
    @media only screen and (max-width: 600px) {
        
        a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}
    
        div[class="column"] { width: auto!important; float:none!important;}
        
        table.social div[class="column"] {
            width:auto!important;
        }
    
    }
</style>

</head>
 
<body bgcolor="#FFFFFF">

<!-- HEADER -->
<table class="head-wrap" bgcolor="#ff4259">
    <tr>
        <td></td>
        <td class="header container">
            
                <div class="content">
                    <table bgcolor="#ff4259">
                        <tr>
                            <td>
                                <a href="{{ shop.url }}" title="{{ shop_name }}" alt="{{ shop_name }}" /><img src="{{ 'logo.png' | asset_url }}" style="width:70px;height:auto;" /></a>
                            </td>
                            <td align="right">
                                <h6 class="collapse">Order Confirmed</h6>   
                            </td>
                        </tr>
                    </table>
                </div>
                
        </td>
        <td></td>
    </tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">

            <div class="content">
            <table>
                <tr>
                    <td>
                        <br/>
                        <h3>Thanks{% if billing_address.name %}, {{ billing_address.name }}{% endif %}</h3>
                        
                        <!-- You may like to include a Hero Image -->
                        <p><img src="http://placekitten.com/g/600/300" alt="" /></p>
                        <!-- /Hero Image -->
                        
                        <br/>
                        
                        <h4>Your Order <small>{{ date | date: "%d/%m/%Y" }}</small></h4>
                        <p>Thank you for placing your order with {{ shop_name }}. This email is to confirm your order has been placed successfully, and will be processed & shipped to you soon.</p>
                            
                        <br/>

                        <!-- Line Items -->
                        {% for line in line_items %}
                        <div class="products">
                            <img src="{{ line.product.featured_image | product_img_url: 'small' }}" />
                            <span> {{ line.quantity }}x {{ line.title }} / {{ line.price | money }}</span>
                        </div>
                        <hr>
                        <div style="clear:both;"></div>
                        {% endfor %}
                        <!-- /Line Items -->
                        
                        <br/>
                        <br/>
                        
                        <!-- Totals -->
                        <h5><b>Subtotal:</b> {{ subtotal_price | money_with_currency }}</h5>
                        
                        <!-- Totals -->
                        <table class="columns" width="100%">
                            <tr>
                                <td>
                                    
                                    {% if requires_shipping %}
                                        <!--- column 1 -->
                                        <table align="left" class="column">
                                            <tr>
                                                <td>
                                                    <p><b>Shipping:</b> {{ shipping_price | money_with_currency }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- /column 1 -->
                                    {% endif %}
                                    
                                    <!-- Discounts -->
                                    {% if discounts %}
                                        <!--- column 2 -->
                                        <table align="left" class="column">
                                            <tr>
                                                <td>
                                                    <p><b>Discounts:</b> {{ discounts_savings | money_with_currency }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- /column 2 -->
                                    {% endif %}
                                    <!-- /Discounts -->
                                    
                                    <span class="clear"></span> 
                                    
                                </td>
                            </tr>
                        </table>
                        <!-- /Totals -->
                        
                        {% for tax_line in tax_lines %}
                            <p><b>{{ tax_line.title }}:</b> {{ tax_line.price | money_with_currency }}</p>
                        {% endfor %}
                        
                        <br/>
                        <br/>
                        
                        <h4><b>Total: {{ total_price | money_with_currency }}</b></h4>
                        <!-- /Totals -->
                        
                        <br/>

                        <!-- address detals -->
                        <table class="columns" width="100%">
                            <tr>
                                <td>
                                    {% if requires_shipping and shipping_address %}
                                        <!--- column 1 -->
                                        <table align="left" class="column">
                                            <tr>
                                                <td>                
                                                    <h5 class="">Shipping address</h5>
                                                    <p class="">
                                                        {{ shipping_address.name }}<br/>
                                                        {{ shipping_address.street }}<br/>
                                                        {{ shipping_address.city }}<br/>
                                                        {{ shipping_address.province }}
                                                        {{ shipping_address.zip }}<br/>
                                                        {{ shipping_address.country }}</p>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    <!-- /column 1 -->
                                    {% endif %}
                                    
                                    {% if billing_address %}
                                        <!--- column 2 -->
                                        <table align="left" class="column">
                                            <tr>
                                                <td>                                            
                                                    <h5 class="">Billing address</h5>                               
                                                    <p class="">
                                                        {{ billing_address.name }}<br/>
                                                        {{ billing_address.street }}<br/>
                                                        {{ billing_address.city }}<br/>
                                                        {{ billing_address.province }}
                                                        {{ billing_address.zip }}<br/>
                                                        {{ billing_address.country }}</p>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- /column 2 -->
                                    {% endif %}
                                    
                                    <span class="clear"></span> 
                                    
                                </td>
                            </tr>
                        </table>
                        <!-- /address details -->
                        
                        <br/>
                        
                        <p style="text-align:center;">
                            <a class="btn" href="{{ shop.url }}/account">Log in to view your order &raquo;</a>
                        </p>
                        
                        <br/>
                        
                        <p><small>If you can't get the button to work, paste this link into your browser: {{ shop.url }}/account</small></p>
                    
                    </td>
                </tr>
            </table>
            </div>
                                    
        </td>
        <td></td>
    </tr>
</table>
<!-- /BODY -->

<!-- FOOTER -->
<table class="footer-wrap" bgcolor="#ff4259">
    <tr>
        <td></td>
        <td class="container">
            
                <!-- content -->
                <div class="content">
                <table>
                <tr>
                    <td align="center">
                        <p>Thank you for shopping at <a href="{{ shop.url }}" style="color:#111111;">{{ shop.name }}</a>!</p>
                        <a href="{{ shop.url }}" title="{{ shop_name }}"><img src="{{ 'logo.png' | asset_url }}" style="width:40px;height:auto;" alt="{{ shop_name }}" /></a>
                        <br/><br/>
                        <p><strong><a href="{{ shop.email }}" style="color:#111111;">{{ shop.email }}</a></strong></p>
                        <p><small>� {{ shop.name }}</small></p>
                    </td>
                </tr>
            </table>
                </div><!-- /content -->
                
        </td>
        <td></td>
    </tr>
</table><!-- /FOOTER -->

</body>
</html>
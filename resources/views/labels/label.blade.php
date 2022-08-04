<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ENDEVOUR</title>
  <link href="labels.css" rel="stylesheet" type="text/css">
  <style>
    body {
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
    width: 5.000000cm;
    height: 2.200000cm;
        }
    .label{
    margin: 0;
    padding-top: 10.000000px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 10.000000px;
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
    width: 4.800000cm;
    height: 1.900000cm;

    font-family: Century Gothic;
    font-size: 9.000000px;
    font-weight: bold;

    float: left;

    text-align: Left;
    overflow: hidden;
        }
    .page-break  {
        clear: left;
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        display:block;
        page-break-after:always;
        }
    .pharmacyBlock {
        display:block;
    }
    .pharmacyLogo {
        margin-left: 5.000000px;
        display: inline-block;
        width: 15.000000px;
        height: 15.000000px;
    }
    .pharmacyname  {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;

        display:inline-block;
        font-family: Century Gothic;
        font-size: 12.000000px;
        line-height: 5px;
        }
    .descriptionvalue  {
        margin: 0;
        margin-left: 0%;
        margin-top: descriptionMargin%;
        padding: 0;
        border: 0;
        outline: 0;

        display:block;
        font-family: Century Gothic;
        font-size: 9.000000px;
        text-overflow: ellipsis;
        white-space: pre;
        line-height: 5px;
        }
    .pricevalue  {
        margin: 0;
        margin-left: 20.000000%;
        margin-top: 5.000000%;
        padding: 0;
        border: 0;
        outline: 0;

        display:block;
        font-family: Century Gothic;
        font-size: 12.000000px;
        line-height: 5px;
        }
    .origindate  {
        margin: 0;
        margin-left: 0%;
        margin-top: 5.000000%;
        padding: 0;
        border: 0;
        outline: 0;

        display:block;
        font-family: Century Gothic;
        font-size: 9.000000px;
        line-height: 5px;
        }

  </style>

</head>

<body onload="printFunction();">
<div class="label">
<span class="pharmacyBlock">
<p class="pharmacyname">STORE PHARMACY</p>
<img src="https://i.imgur.com/L1Zfjan.jpeg" class="pharmacyLogo" />
</span>
<p class="descriptionvalue">FLUANXOL 0.5MG X 60 TABS                                     </p>
<p class="pricevalue">&euro;5.78</p>
<p class="origindate">AGENT310321 VAT: 0% Inv: 487021</p>
</div>
<div class="page-break"></div><div class="label">
<span class="pharmacyBlock">
<p class="pharmacyname">STORE PHARMACY</p>
<img src="https://i.imgur.com/L1Zfjan.jpeg" class="pharmacyLogo" />
</span>
<p class="descriptionvalue">RODOGYL X 20 TABS           *                                </p>
<p class="pricevalue">&euro;6.49</p>
<p class="origindate">AGENT310321 VAT: 0% Inv: 487021</p>
</div>
<div class="page-break"></div><div class="label">
<span class="pharmacyBlock">
<p class="pharmacyname">STORE PHARMACY</p>
<img src="https://i.imgur.com/L1Zfjan.jpeg" class="pharmacyLogo" />
</span>
<p class="descriptionvalue">MATERNA DHA 24X34G (NESTLE)                                  </p>
<p class="pricevalue">&euro;13.49</p>
<p class="origindate">AGENT310321 VAT: 0% Inv: 487021</p>
</div>
<div class="page-break"></div>

<script>
function printFunction() {
  var r = confirm("Do you want to open the print dialouge now?");
  if (r == true) {
    window.print();;
  } else {
    // closes alert
  }
}
</script>

</body>

</html>
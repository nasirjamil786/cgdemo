<!--Signature java script -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript">
    var signature = {
        canvas: null,
        clearButton: null,

        init: function init() {
            this.canvas = document.querySelector(".signature-pad");
            this.clearButton = document.getElementById('clear');
            signaturePad = new SignaturePad(this.canvas);
            this.clearButton.addEventListener('click', function (event) {
                 signaturePad.clear();
            });
        }
    };

    signature.init();
</script>

<script type="text/javascript">

    function submitForm() {

        if(document.getElementById("ignore_signature")){
            if(signaturePad.isEmpty() && ignore_signature.checked == false){
                 alert('Signature is required, please sign the terms & conditions');
                 return false;            
            } else {
                document.getElementById('signature').value = signaturePad.toDataURL();
            }
        } else {
            if(signaturePad.isEmpty()){
                 alert('Signature is required, please sign the terms & conditions');
                 return false;            
            } else {
                document.getElementById('signature').value = signaturePad.toDataURL();
            }
        }
    }
</script>
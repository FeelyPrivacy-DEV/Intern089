

<script src="http://127.0.0.1/s/s/assest/bootstrap/js/jquery.js"></script>
<script src="http://127.0.0.1/s/s/assest/bootstrap/js/bootstrap.js"></script>
<script src="http://127.0.0.1/s/s/assest/bootstrap/jquery-ui/jquery-ui/jquery-ui.js"></script>
<script src="http://127.0.0.1/s/s/assest/bootstrap/jquery-ui/jquery-ui/jquery-ui.min.js"></script>
<script src="http://127.0.0.1/s/s/assest/DataTables/datatables.min.js"></script>
<script src="http://127.0.0.1/s/s/assest/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
<script src='http://127.0.0.1/s/s/assest/payment.js'></script>
<script src="http://127.0.0.1/s/s/assest/dropzone/dropzone.min.js"></script>
    <!--[if IE 8]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/ie8/0.2.5/ie8.js"></script>
  <![endif]-->

    <!--[if lte IE 9]>
  <script src="https://cdn.auth0.com/js/polyfills/1.0/base64.min.js"></script>
  <script src="https://cdn.auth0.com/js/polyfills/1.0/es5-shim.min.js"></script>
  <![endif]-->


  
  <!-- watson assistant -->
  <script>
        window.watsonAssistantChatOptions = {
            integrationID: "55fef16e-0a3b-4f00-82ac-45a62eeb8618", // The ID of this integration.
            region: "kr-seo", // The region your integration is hosted in.
            serviceInstanceID: "04ccbfcb-3c7c-4eab-a57d-6e58812acb40", // The ID of your service instance.
            onLoad: function(instance) { instance.render(); }
            };
        setTimeout(function(){
            const t=document.createElement('script');
            t.src="https://web-chat.global.assistant.watson.appdomain.cloud/loadWatsonAssistantChat.js"
            document.head.appendChild(t);
        });
    </script>


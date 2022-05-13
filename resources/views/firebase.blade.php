<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="alert alert-danger" id="error" style="display: none;"></div>

        <div class="card">
            <div class="card-header">
                Enter Phone Number
            </div>
            <div class="card-body">

                <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>

                <form>
                    <label>Phone Number:</label>
                    <input type="text" id="number" class="form-control" placeholder="+91********">
                    <div id="recaptcha-container"></div>
                    <button type="button" class="btn btn-success" onclick="phoneSendAuth();">SendCode</button>
                </form>
            </div>
        </div>

        <div class="card" style="margin-top: 10px">
            <div class="card-header">
                Enter Verification code
            </div>
            <div class="card-body">

                <div class="alert alert-success" id="successRegsiter" style="display: none;"></div>

                <form>
                    <input type="text" id="verificationCode" class="form-control"
                        placeholder="Enter verification code">
                    <button type="button" class="btn btn-success" onclick="codeverify();">Verify code</button>

                </form>
            </div>
        </div>

    </div>

    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyBvrCDkJj9cbU5M198h4EJsI3aV2Z1CZBg",
            authDomain: "family-photo-album-349706.firebaseapp.com",
            projectId: "family-photo-album-349706",
            storageBucket: "family-photo-album-349706.appspot.com",
            messagingSenderId: "752537266211",
            appId: "1:752537266211:web:3272f62b52e264abfe2996",
            measurementId: "G-15Y52GGCHF"
        };

        firebase.initializeApp(firebaseConfig);
    </script>

    <script type="text/javascript">
        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container',{
                'size': 'invisible',
            });
            // console.log(window.recaptchaVerifier);
            recaptchaVerifier.render();
        }

        function phoneSendAuth() {

            var number = $("#number").val();
            var status = firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {

                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                // console.log(coderesult);

                $("#sentSuccess").text("Message Sent Successfully.");
                $("#sentSuccess").show();

            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
            console.log(status);
        }

        function codeverify() {

            var code = $("#verificationCode").val();

            coderesult.confirm(code).then(function(result) {
                var user = result.user;
                console.log(result);
                console.log(user);

                $("#successRegsiter").text("you are register Successfully.");
                $("#successRegsiter").show();

            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>

</body>

</html>

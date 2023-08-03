<!-- Registration Form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Registration Form</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Name</label>
                                <input id="name" placeholder="Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="Your Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Phone Number</label>
                                <input id="phone" placeholder="Your Phone" class="form-control" type="phone"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100  btn-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

    async function onRegistration(){
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let phone = document.getElementById('phone').value;
        let password = document.getElementById('password').value;

        if(name.length===0){
            errorToast("Name is required.")
        }
        else if(email.length===0){
            errorToast("Email address is required.")
        }
        else if(phone.length===0){
            errorToast("Phone number is required.")
        }
        else if(password.length===0){
            errorToast("Password is required.")
        }

        else{
            showLoader();
            let response = await axios.post('/user-registration', {
                name:name,
                email:email,
                phone:phone,
                password:password
            });
            hideLoader();
            if(response.status===200 && response.data['status']==='success'){
                successToast(response.data['message']);
                setTimeout(function() {
                    window.location.href='/signin-page';
                }, 1000);
            } else{
                errorToast(response.data['message']);
            }
        }

    }

</script>

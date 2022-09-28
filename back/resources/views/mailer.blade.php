<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Poppins:wght@600&family=Rubik:ital,wght@1,900&display=swap" rel="stylesheet">
</head>
<body style="margin: 0;padding:0;font-family: 'Nunito Sans', sans-serif;">
    <div class="container" style="background: rgb(236, 245, 251);padding:10px;">
        <div class="container_mail" style="width: 60%;margin:auto;background: #fff;margin-top: 4vh; padding: 25px;height: 70vh;box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;border-top: 5px solid rgb(252, 175, 33);border-radius: 10px;">
            <h1 style="text-align: center;font-family: 'Nunito Sans', sans-serif; font-weight: bolder; color: black;margin: 0;padding: 0;">Verify This Email Address</h1>
            <div class="profile" style="display: flex;justify-content:center;margin-bottom: 30px;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7xC4-_EaIBdFBNBoKdmrq5p19V5Ei5w7Mjg&usqp=CAU" alt="" style="width: 15%;border-radius: 50rem;margin-left:17.3vw;">
            </div>
            <div class="text" style="margin-bottom: 60px;">
                <span style="text-align: center;font-size:larger;margin-left:5px;color:black;">Dear {{$user['first_name']}} {{$user['last_name']}},</span>
                <p style="text-align: center;font-size: larger;color:black;">I am a Coordinator. I have added you get started in social affair follow up application. First, you need to confirm your account. This is your Email you need to confirm {{$user['email']}}. <b>Please press the button below.</b></p>
            </div>
            <div class="btn-confrim" style="margin-bottom: 70px;display: flex;justify-content: center;">
                <a href="http://localhost:3000/login" style="text-decoration: none;background:rgb(68, 68, 252);padding: 12px;color: #fff;border-radius: 10px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;margin-left:15.5vw;cursor:pointer">Confirm Account</a>
            </div>
        </div>
    </div>
</body>
</html>